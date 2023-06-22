<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePriceRequest;
use App\Http\Resources\PriceResource;
use App\Models\Price;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PriceController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $prices = Price::paginate(10);
        return PriceResource::collection($prices);
    }

    public function show(Price $price): PriceResource
    {
        return new PriceResource($price);
    }

    public function store(StorePriceRequest $request): PriceResource
    {
        $price = Price::create([
            'value' => $request->input('value'),
            'product_id' => $request->input('product_id')
        ]);

        return new PriceResource($price);
    }

    public function update(Price $price, StorePriceRequest $request): PriceResource
    {
        $price->update([
            'value' => $request->input('value'),
            'product_id' => $request->input('product_id')
        ]);

        return new PriceResource($price);
    }

    public function destroy(Price $price): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        $price->delete();
        return response(null, 204);
    }
}
