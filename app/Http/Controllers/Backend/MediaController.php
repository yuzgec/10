<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function delete(Request $request)
    {
        $modelType = "App\\Models\\" . $request->model_type;
        $model = $modelType::findOrFail($request->model_id);
        
        $result = $this->mediaService->deleteSingleMedia($model, $request->collection);

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Medya başarıyla silindi' : 'Medya silinirken bir hata oluştu'
        ]);
    }
} 