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
use App\Http\Requests\Admin\ProductStatusRequest;


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

    /**
     * Display the Add product page
     * with differ so that i can display the add product page
     * then follow the category.
     *
     * @return void
     */
    public function productsAdd()
    {
        return Inertia::render('Admin/Products/AddProduct', [
            'category' => Inertia::defer(fn() => $this->categoryService->getCategoryProduct()),
        ]);
    }

    /**
     * Display the edit Page for products
     * Pass two data, product and categories,
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id)
    {
        $product = $this->productService->findById($id);
        $categories = $this->categoryService->getCategoryProduct(); // reuse your existing method

        return Inertia::render('Admin/Products/AddProduct', [
            'product'  => $product,
            'category' => $categories,
        ]);
    }

    /**
     * Handle the incoming request to create a new product. 
     * Validates the request data and passes it to the service layer.
     * result:
     * pass the validated data as an array into the productService
     * where the business logic is then after that get 
     * redirect into addproduct page with succss msg
     *
     * @param ProductRequest $request
     * @return void
     */
    public function store(ProductRequest $request)
    {
        $this->productService->createProduct($request->validated(), $request->file('image'));
        return redirect()->route('addProducts')->with('success', "Category Added Successfully!");
    }

    /**
     * Handle the Product Update
     * Validate the incoming request via ProductRequest.
     * result:
     * Pass the validated data and optional image file to the productService for updating.
     * After a successful update, redirect back to the category index with a success message.
     * 
     * @param [type] $id
     * @param ProductRequest $request
     * @return void
     */
    public function update(int $id, ProductRequest  $request)
    {
        $this->productService->updateCategory($id, $request->validated(), $request->file('image'));
        return redirect()->route('products')->with('success', "Category Added Successfully!");
    }

    /**
     * Handle the Product Status
     * validate the incoming request
     * result:
     * pass the validated status to productService
     * after a successful update status, redirect back to the products
     * 
     * @param integer $id
     * @param ProductStatusRequest $request
     * @return void
     */
    public function statusUpdate(int $id, ProductStatusRequest $request)
    {
        $this->productService->updateStatus($id, $request->validated(),);
        return redirect()->route('products')->with('success', "Category status updated Successfully!");
    }

    /**
     * Delete Product by id
     * then redirect to the products page
     * 
     *
     * @param [type] $id
     * @return void
     */
    public function destroy(int $id)
    {
        $this->productService->deleteProduct($id);
        return redirect()->route('products')->with('success', 'Category deleted successfully!');
    }
}
