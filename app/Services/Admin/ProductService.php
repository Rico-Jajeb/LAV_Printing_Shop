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
