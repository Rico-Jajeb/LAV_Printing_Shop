<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

#Repository
use App\Repositories\Admin\CategoryRepository;

#Services
use App\Services\Admin\CategoryService;
use App\Services\ImageService;

#Request
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\CategoryStatusRequest;

class CategoryProductController extends Controller
{

    protected $categoryService;
    protected $imageService;
    protected $categoryRepository;

    public function __construct(CategoryService $categoryService, ImageService $imageService, CategoryRepository $categoryRepository)
    {
        $this->categoryService =  $categoryService;
        $this->imageService =  $imageService;
        $this->categoryRepository =  $categoryRepository;
    }

    /**
     * Display Category Page 
     * using the defer built in inertia
     * it load the category page first, then follow 
     * the categoryData
     *
     * @return void
     */
    public function index()
    {
        return Inertia::render('Admin/Products/Categories', [
            'category' => Inertia::defer(fn() => $this->categoryService->getCategoryProduct()),
        ]);
    }

    /**
     * Handle the incoming request to create a new category. 
     *  Validates the request data and passes it to the service layer.
     *
     * @param CategoryRequest $request
     * @return void
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryService->createCategory($request->validated(), $request->file('image'));
        return redirect()->route('category')->with('success', "Category Added Successfully!");
    }

    /**
     * Handle the Category Update
     * Validate the incoming request via CategoryRequest.
     * Pass the validated data and optional image file to the CategoryService for updating.
     * After a successful update, redirect back to the category index with a success message.
     * 
     * @param [type] $id
     * @param CategoryRequest $request
     * @return void
     */
    public function update($id, CategoryRequest  $request){
        $this->categoryService->updateCategory($id, $request->validated(), $request->file('image'));
        return redirect()->route('category')->with('success', "Category Added Successfully!");
    }

    /**
     * Handle the Category Status
     * validate the incoming request
     * pass the validated status to categoryService
     * after a successful update status, redirect back to the category
     * 
     * @param integer $id
     * @param CategoryStatusRequest $request
     * @return void
     */
    public function statusUpdate(int $id, CategoryStatusRequest $request)
    {
        $this->categoryService->updateStatus($id, $request->validated(),);
        return redirect()->route('category')->with('success', "Category status updated Successfully!");
    }

    /**
     * Delete Category Product by id
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

}
