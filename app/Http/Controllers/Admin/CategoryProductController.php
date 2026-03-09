<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryProductController extends Controller
{
    public function index(){
            $customers = [
        [
            'id' => 1,
            'name' => 'John Doe',
            'description' => 'Desc1',
            'country' => [
                'name' => 'United States',
                'code' => 'us'
            ],
            'representative' => [
                'name' => 'Amy Elsner',
                'image' => 'amyelsner.png'
            ],
            'status' => 'qualified'
        ],
        [
            'id' => 2,
            'name' => 'Maria Garcia',
            'description' => 'Desc2',
            'country' => [
                'name' => 'Spain',
                'code' => 'es'
            ],
            'representative' => [
                'name' => 'Anna Fali',
                'image' => 'annafali.png'
            ],
            'status' => 'new'
        ]
    ];

        return Inertia::render('Admin/Products/Categories', [
            'customers' => $customers
            ]);
    }
}
