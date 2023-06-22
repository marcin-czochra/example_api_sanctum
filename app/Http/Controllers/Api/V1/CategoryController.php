<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::select('id', 'name', 'created_at')->get();
        return CategoryResource::collection($categories);
    }

    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    public function store(StoreCategoryRequest $request): CategoryResource
    {
        $category = Category::create($request->all());

        return new CategoryResource($category);
    }

    public function update(Category $category, StoreCategoryRequest $request): CategoryResource
    {
        $category->update($request->all());
        return new CategoryResource($category);
    }

    public function destroy (Category $category): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        DB::table('products')
            ->where('category_id', $category->id)
            ->update(['category_id' => null]);

        $category->delete();
        return response(null, 204);
    }
}

