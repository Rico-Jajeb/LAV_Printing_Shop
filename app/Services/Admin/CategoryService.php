<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Log;

use App\Repositories\Admin\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoryProduct()
    {
        try {
            return $this->categoryRepository->getAll();
        } catch (\Throwable $e) {
            Log::error('Category fetch failed: ' . $e->getMessage());
            return collect();
        }
    }
}
