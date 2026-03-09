<?php

namespace App\Repositories\Admin;

use App\Models\CategoryProductModel;

class CategoryRepository
{

    public function getAll()
    {
        return CategoryProductModel::all();
    }
}
