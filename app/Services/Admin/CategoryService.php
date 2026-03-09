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

    /**
     * Get Data from DB and do try catch 
     *
     * @return void
     */
    public function getCategoryProduct()
    {
        try {
            return $this->categoryRepository->getAll();
        } catch (\Throwable $e) {
            Log::error('Category fetch failed: ' . $e->getMessage());
            return collect();
        }
    }

    /**
     *  Create a new category using the repository.
     *
     * @param array $data
     * @return void
     */
    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data);
    }
}
