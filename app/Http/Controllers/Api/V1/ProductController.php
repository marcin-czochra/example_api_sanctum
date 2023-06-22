<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $products = Product::with('category', 'prices')->paginate(10);
        return ProductResource::collection($products);
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id')
        ]);

        return new ProductResource($product);
    }

    public function update(Product $product, StoreProductRequest $request): ProductResource
    {
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id')
        ]);

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        DB::table('prices')
            ->where('priceable_id', $product->id)
            ->update(['priceable_id' => null]);

        $product->delete();
        return response(null, 204);
    }
}
