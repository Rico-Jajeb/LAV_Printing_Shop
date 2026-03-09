<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

#Services
use App\Services\Admin\CategoryService;

class CategoryProductController extends Controller
{

    protected $CategoryService;

    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService =  $CategoryService;
    }

    public function index()
    {
        $category = $this->CategoryService->getCategoryProduct();

        return Inertia::render('Admin/Products/Categories', [
            'category' => $category
        ]);
    }

}
