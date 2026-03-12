<?php

namespace App\Repositories\Admin;

use App\Models\CategoryProductModel;
use App\Models\ProductModel;
use Illuminate\Support\Arr;

use Illuminate\Database\Eloquent\Collection;
class ProductRepository
{

    /**
     * Get all product data from db
     *
     * @return void
     */
    public function getAll()
    {
        return ProductModel::all();
    }


    public function create(array $data)
    {
        return ProductModel::create($data);
    }

      public function findById(int $id)
    {
        return ProductModel::find($id);
    }
    
    // In ProductRepository
    public function findByCategoryId(int $categoryId): Collection
    {
        return ProductModel::where('product_category_id', $categoryId)->get();
    }


     /**
     * Update the category
     * it find the ID then send it to DB
     *
     * @param integer $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data)
    {
        $category = $this->findById($id);

        return $category->update($data);
    }


    
    /**
     * Delete the category 
     *
     * @param ProductModel $category
     * @return boolean
     */
    public function delete(ProductModel $products): bool
    {
        return $products->delete();
    }

}   
