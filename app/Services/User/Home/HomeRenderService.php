<?php

namespace App\Services\User\Home;

use App\Models\Shared\Content\{
    Banner,
    Article,
    CollectionPoint,
    EstablishmentButton,
    EstablishmentAsset,
    MediaGallery,
    FeaturedImage,
    WeatherInsight
};
use App\Models\Shared\Home\{
    HomeVideo,
    HomePage,
    GalleryEvent,
    UserMessage
};

use App\Services\Shared\CalendarService;
use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;

class HomeRenderService
{
    protected CalendarService $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function getHomeData(): array
    {
        $banners = Banner::where('is_active', true)
            ->orderBy('order')
            ->take(13)
            ->get();

        $media = MediaGallery::where('is_active', true)
            ->orderBy('order')
            ->take(8)
            ->get();

        $video = HomeVideo::first();

        $page = HomePage::where('is_active', true)->first(['id', 'name']);

        $weatherInsights = WeatherInsight::where('is_active', true)
            ->limit(4)
            ->orderBy('order')
            ->get();

        $establishments = EstablishmentButton::where('is_active', true)
            ->limit(5)
            ->orderBy('order')
            ->get();

        $hasAccredited = EstablishmentAsset::where('is_active', true)
            ->where('category', 'accredited')
            ->exists();

        $hasFavorable = EstablishmentAsset::where('is_active', true)
            ->where('category', 'favorable')
            ->exists();

        $points = CollectionPoint::where('is_active', true)
            ->orderBy('order')
            ->take(4)
            ->get()
            ->keyBy('order');

        $articles = Article::where('is_active', true)
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        $galleries = GalleryEvent::where('is_active', true)
            ->whereHas('images', fn($q) => $q->where('is_active', true))
            ->with(['images' => fn($q) => $q->where('is_active', true)->orderBy('order')])
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        $featuredImage = FeaturedImage::where('is_active', true)
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->first();

        $events = $this->calendarService->getActiveEvents();

        return compact(
            'banners',
            'media',
            'video',
            'page',
            'weatherInsights',
            'establishments',
            'hasAccredited',
            'hasFavorable',
            'points',
            'articles',
            'galleries',
            'featuredImage',
            'events'
        );
    }

    public function createMessage(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:200',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:200',
                'location' => 'required|string|max:200',
                'topic' => 'required|string|max:200',
                'comments' => 'required|string|max:2000',
            ]);
        } catch (ValidationException $e) {
            return back()
                ->with('contact_message_error', 'No se pudo enviar el mensaje. Por favor revisa los campos.')
                ->throwResponse();
        }

        foreach ($validated as $key => $value) {
            $validated[$key] = strip_tags(trim($value));
        }

        UserMessage::create($validated);
    }
}
