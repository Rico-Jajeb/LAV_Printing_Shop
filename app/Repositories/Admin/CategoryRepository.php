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
}
