<?php

namespace App\Services\Admin;


use App\Models\CategoryProductModel;

use App\Repositories\Admin\CategoryRepository;

class CategoryService
{

    protected $CategoryRepository;

    public function __construct(CategoryRepository $CategoryRepository,)
    {
        $this->CategoryRepository = $CategoryRepository;
    }

    public function getCategoryProduct()
    {
        return $this->CategoryRepository->getAll();
    }
}
