<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


use App\Repositories\Admin\ProductRepository;

#Services
use App\Services\ImageService;

class ProductService
{
    protected $productRepository;
    protected $imageService;

    public function __construct(ProductRepository $productRepository, ImageService $imageService)
    {
        $this->productRepository = $productRepository;
        $this->imageService = $imageService;
    }

    /**
     * Get  Product Data from DB 
     * add Try Catch incase db failed
     *
     * @return void
     */
    public function getProduct()
    {
        try {
            return $this->productRepository->getAll();
        } catch (\Throwable $e) {
            Log::error('Product fetch failed: ' . $e->getMessage());
            return collect();
        }
    }

    /**
     * Recieve the validated data that the controller send
     * then insert the data and image into the product repo
     * also use the imageservice to handle the image processing
     *
     * @param array $data
     * @param [type] $image
     * @return void
     */
    public function createProduct(array $data, $image = null){

       if ($image) {
            $data['image'] = $this->imageService->processAndUpload(
                $image,
                'products',
                600,
                80
            );
        }
        return $this->productRepository->create($data);

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
        $product = $this->productRepository->findById($id);

        if (!$product) {
            throw new \Exception("Category not found");
        }

        if ($image) {
            if ($product->image && Storage::disk('r2')->exists($product->image)) {
                Storage::disk('r2')->delete($product->image);
            }

            $data['image'] = $this->imageService->processAndUpload(
                $image,
                'products',
                600,
                80
            );
        } else {
            unset($data['image']);
        }

        return $this->productRepository->update($id, $data);
    }




public function findById(int $id)
{
    return $this->productRepository->findById($id);
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
        $category = $this->productRepository->findById($id);

        if (!$category) {
             throw new \Exception("Category not found");
        }

        return $this->productRepository->update($id, $data);
    }


    public function deleteProduct(int $id): bool
    {
       
        // Delete all product images in this category from R2
        $products = $this->productRepository->findById($id);
    
        // Delete the category image from R2
        if ($products->image && Storage::disk('r2')->exists($products->image)) {
            Storage::disk('r2')->delete($products->image);
        }

        return $this->productRepository->delete($products);
    }

    
}
