<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Log;

use App\Repositories\Admin\CategoryRepository;

#Services
use App\Services\ImageService;

class CategoryService
{
    protected $categoryRepository;
    protected $imageService;

    public function __construct(CategoryRepository $categoryRepository, ImageService $imageService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->imageService = $imageService;
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
     * Create a new category using the repository.
     * Also Handle the image with the imageService
     * You can declare where the image should be
     * store in the cloudfare R2 from here based
     * on the example categories is the folder
     *
     * @param array $data
     * @param [type] $image
     * @return void
     */
    public function createCategory(array $data, $image = null)
    {
        if ($image) {
            $data['image'] = $this->imageService->processAndUpload(
                $image,
                'categories',
                600,
                80
            );
        }
        return $this->categoryRepository->create($data);
    }

}
