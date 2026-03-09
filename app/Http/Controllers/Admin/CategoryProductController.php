<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

#Services
use App\Services\Admin\CategoryService;

class CategoryProductController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService =  $categoryService;
    }


    public function index()
    {
        return Inertia::render('Admin/Products/Categories', [
            'category' => Inertia::defer(fn () => $this->categoryService->getCategoryProduct()),
        ]);
    }

}
