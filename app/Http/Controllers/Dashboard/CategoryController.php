<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function create()
    {
        return inertia("Dashboard/Category/Create");
    }

    public function store(Request $request)
    {
        Category::create(
            [
                'title' => request('title'),
                'slug' => request('slug'),
            ]
            );
        dd($request->all());
    }

}
