<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

#Repository
use App\Repositories\Admin\CategoryRepository;

#Services
use App\Services\Admin\CategoryService;
use App\Services\Admin\ProductService;
use App\Services\ImageService;

#Request
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\ProductRequest;


class ProductController extends Controller
{

    protected $categoryService;
    protected $productService;
    protected $imageService;
    protected $categoryRepository;

    public function __construct(CategoryService $categoryService, ProductService $productService, ImageService $imageService, CategoryRepository $categoryRepository)
    {
        $this->categoryService =  $categoryService;
        $this->productService =  $productService;
        $this->imageService =  $imageService;
        $this->categoryRepository =  $categoryRepository;
    }

    /**
    * Display Product Page 
     * using the defer built in inertia
     * it load the category page first, then follow 
     * the categoryData
     *
     * @return void
     */
    public function index()
    {
        return Inertia::render('Admin/Products/Products', [
            'product' => Inertia::defer(fn() => $this->productService->getProduct()),
        ]);
    }




    public function store(ProductRequest $request)
    {
        $this->productService->createProduct($request->validated(), $request->file('image'));
        return redirect()->route('addProducts')->with('success', "Category Added Successfully!");
    }



    /**
     * Handle the Category Update
     * Validate the incoming request via CategoryRequest.
     * Pass the validated data and optional image file to the CategoryService for updating.
     * After a successful update, redirect back to the category index with a success message.
     * 
     * @param [type] $id
     * @param ProductRequest $request
     * @return void
     */
    public function update($id, ProductRequest  $request){
        $this->productService->updateCategory($id, $request->validated(), $request->file('image'));
        return redirect()->route('products')->with('success', "Category Added Successfully!");
    }



    /**
     * Delete Category Product by id
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }




public function edit($id)
{
    $product = $this->productService->findById($id);
    $categories = $this->categoryService->getCategoryProduct(); // reuse your existing method

    return Inertia::render('Admin/Products/AddProduct', [
        'product'  => $product,
        'category' => $categories,
    ]);
}


    public function productsAdd()
    {
        return Inertia::render('Admin/Products/AddProduct', [
            'category' => Inertia::defer(fn() => $this->categoryService->getCategoryProduct()),
        ]);
    }
}
