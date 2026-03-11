<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


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
     * Get Category Product Data from DB 
     * add Try Catch incase db failed
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

    /**
     * Update The category by id
     * Check if the id from user page is in DB
     * then check if the update is also updating the image
     * if yes, then it check if the image exist in cloudflare 
     * if it exist then it delete the image in cloudflare
     * then upload the latest image, 
     * If no new image in update keep the existing image
     * then send the data into repository DB
     * 
     * @param integer $id
     * @param array $data
     * @param [type] $image
     * @return void
     */
    public function updateCategory(int $id, array $data, $image = null)
    {
        $category = $this->categoryRepository->findById($id);

        if (!$category) {
            throw new \Exception("Category not found");
        }

        if ($image) {
            if ($category->image && Storage::disk('r2')->exists($category->image)) {
                Storage::disk('r2')->delete($category->image);
            }

            $data['image'] = $this->imageService->processAndUpload(
                $image,
                'categories',
                600,
                80
            );
        } else {
            unset($data['image']);
        }

        return $this->categoryRepository->update($id, $data);
    }



    /**
     * Update the category status selected
     * check the id is in db
     * if the id is not in db then it throw the error category not found
     * but if it exist then now update the status
     *
     * @param integer $id
     * @param array $data
     * @return void
     */
    public function updateStatus(int $id, array $data)
    {
        $category = $this->categoryRepository->findById($id);

        if (!$category) {
             throw new \Exception("Category not found");
        }

        return $this->categoryRepository->update($id, $data);
    }



    /**
     * Find the category by id
     * Then check if the category Image exist 
     * in cloudflare r2, if so then delete it
     * then delete the category data in DB
     *  
     * @param integer $id
     * @return boolean
     */
    public function deleteCategory(int $id): bool
    {
        $category = $this->categoryRepository->findById($id);

        if ($category->image && Storage::disk('r2')->exists($category->image)) {
            Storage::disk('r2')->delete($category->image);
        }

        return $this->categoryRepository->delete($category);
    }
}
