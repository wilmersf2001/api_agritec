<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Business\AbilitiesResolver;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return CategoryResource::collection($categories);
    }

    public function store(Request $request)
    {
        AbilitiesResolver::autorize('categories.store');
        $category = Category::create($request->all());
        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(Category $category, Request $request)
    {
        AbilitiesResolver::autorize('categories.update');
        $category->update($request->all());
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        AbilitiesResolver::autorize('categories.destroy');
        $category->delete();
        return new CategoryResource($category);
    }

    public function products(Category $category)
    {
        return $category->products;
    }
}
