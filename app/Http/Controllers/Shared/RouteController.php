<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class RouteController extends Controller
{
    public function show($key)
    {
        $data = Cache::get($key);

        if (!$data || !isset($data['mime'], $data['content'])) {
            abort(404);
        }

        return response(base64_decode($data['content']))
            ->header('Content-Type', $data['mime'])
            ->header('Content-Disposition', 'inline; filename="file"');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'model' => 'required|string',
        ]);

        $baseNamespace = 'App\\Models\\Shared\\Content\\';
        $modelClass = $baseNamespace . $request->model;

        if (!class_exists($modelClass)) {
            return response()->json(['error' => 'Modelo no encontrado.'], 404);
        }

        $instance = $modelClass::find($request->id);

        if (!$instance) {
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }

        if (
            !isset($instance->mime_type) ||
            !isset($instance->content_base64)
        ) {
            return response()->json(['error' => 'Modelo incompatible.'], 422);
        }

        $url = generateBlankLink($instance->content_base64, $instance->mime_type);

        return response()->json(['url' => $url]);
    }
}
