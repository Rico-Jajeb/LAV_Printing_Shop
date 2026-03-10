<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Process and upload via ImageService
            $filename = $this->imageService->processAndUpload($image, 600, 80);
            
            // Save the R2 path in validated data
            $validated['image'] = 'categories/' . $filename;
        }

        $this->categoryService->createCategory($validated);

        return redirect()->route('category')->with('success', "Category Added Successfully!");
    }


}
