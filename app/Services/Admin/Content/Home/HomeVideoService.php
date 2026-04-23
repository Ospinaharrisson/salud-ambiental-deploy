<?php

namespace App\Services\Admin\Content\Home;

use App\Models\Shared\Home\HomeVideo;
use App\Services\Admin\Request\ValidationService;
use Illuminate\Http\Request;

class HomeVideoService
{
    protected $validator;

    public function __construct(ValidationService $validator)
    {
        $this->validator = $validator;
    }

    public function store(Request $request): ?HomeVideo
    {
        $this->validator->validateLinkField($request, 'link', required: true);

        $videoId = $this->convertToEmbed($request->link);

        if (!$videoId) {
            return null;
        }

        $video = new HomeVideo();
        $video->link = "https://www.youtube.com/embed/{$videoId}";
        $video->save();

        return $video;
    }

    public function updateVideo(Request $request, int $id): ?HomeVideo
    {
        $this->validator->validateLinkField($request, 'link', required: true);

        $videoId = $this->convertToEmbed($request->link);

        if (!$videoId) {
            return null;
        }

        $video = HomeVideo::findOrFail($id);
        $video->link = "https://www.youtube.com/embed/{$videoId}";
        $video->save();

        return $video;
    }

    private function convertToEmbed(string $url): ?string
    {
        if (str_contains($url, 'youtube.com/embed/')) {
            $path = parse_url($url, PHP_URL_PATH);
            $segments = explode('/', trim($path, '/'));
            return end($segments);
        }

        parse_str(parse_url($url, PHP_URL_QUERY) ?? '', $queryParams);
        if (!empty($queryParams['v'])) {
            return $queryParams['v'];
        }

        $path = parse_url($url, PHP_URL_PATH);
        if ($path && str_starts_with($url, 'https://youtu.be')) {
            return trim($path, '/');
        }

        return null;
    }
}
