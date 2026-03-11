<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
#Services
use App\Services\Admin\CategoryService;
use App\Services\ImageService;

#Request
use App\Http\Requests\Admin\CategoryRequest;

class CategoryProductController extends Controller
{

    protected $categoryService;
    protected $imageService;

    public function __construct(CategoryService $categoryService, ImageService $imageService)
    {
        $this->categoryService =  $categoryService;
        $this->imageService =  $imageService;
    }

    /**
     * Display Category Page with defer
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
