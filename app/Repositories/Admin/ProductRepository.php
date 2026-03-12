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

    /**
     * Create New Product 
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        return ProductModel::create($data);
    }

    /**
     * Find data by id in the db
     *
     * @param integer $id
     */
    public function findById(int $id)
    {
        return ProductModel::find($id);
    }

    /**
     * Find Product Category By Id
     * This is customize to find only product_category_id
     *
     * @param integer $categoryId
     * @return Collection
     */
    public function findByCategoryId(int $categoryId): Collection
    {
        return ProductModel::where('product_category_id', $categoryId)->get();
    }

    /**
     * Update the product
     * Find specific product by id
     *
     * @param integer $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data)
    {
        $product = $this->findById($id);

        return $product->update($data);
    }

    /**
     * Delete the Product by id 
     *
     * @param ProductModel $product
     * @return boolean
     */
    public function delete(ProductModel $products): bool
    {
        return $products->delete();
    }
}
