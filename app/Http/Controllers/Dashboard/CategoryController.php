<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\Put;
use App\Http\Requests\Category\Store;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::paginate(2);
        return inertia("Dashboard/Category/Index",compact("categories"));
    }

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
        sleep(3);
        return inertia("Dashboard/Category/Edit", compact('category'));
    }

    public function update(Put $request, Category $category)
    {
        $category->update($request->validated());
    }

}
