<?php

namespace App\Http\Controllers;

use App\Services\ViewService;
use App\Services\MediaService;
use App\Services\CategoryService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    protected $categoryService;
    protected $mediaService;
    protected $viewService;

    public function __construct(CategoryService $categoryService, MediaService $mediaService, ViewService $viewService)
    {
        $this->categoryService = $categoryService;
        $this->mediaService = $mediaService;
        $this->viewService = $viewService;
    }
}
