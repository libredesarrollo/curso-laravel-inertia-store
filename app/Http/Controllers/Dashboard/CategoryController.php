<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\Store;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function create()
    {
        return inertia("Dashboard/Category/Create");
    }

    public function store(Store $request)
    {
        Category::create($request->validated());
    }

    public function edit(Category $category)
    {
        return inertia("Dashboard/Category/Edit", compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        dd($request->all());
    }

}
