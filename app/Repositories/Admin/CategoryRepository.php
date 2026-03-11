<?php

namespace App\Repositories\Admin;

use App\Models\CategoryProductModel;
use Illuminate\Support\Arr;

class CategoryRepository
{

    /**
     * Get all category product data from db
     *
     * @return void
     */
    public function getAll()
    {
        return CategoryProductModel::all();
    }

    /**
     *  Insert a new category record into the database.
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        return CategoryProductModel::create($data);
    }


   
    public function findById(int $id)
    {
        return CategoryProductModel::find($id);
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
     * @param CategoryProductModel $category
     * @return boolean
     */
    public function delete(CategoryProductModel $category): bool
    {
        return $category->delete();
    }

}   
