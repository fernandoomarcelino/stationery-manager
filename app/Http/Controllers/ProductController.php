<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductStore;
use App\Http\Requests\Product\ProductUpdate;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Product::all();
        return response($resources->toJSON(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStore $request, Product $resource)
    {
        $resource = $resource->create($request->all());
        return $this->show($resource->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resource = Product::findOrFail($id);
        return response($resource->toJson(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdate $request, $id)
    {
        $resource = Product::findOrFail($id);
        $resource->fill($request->all())->save();
        return $this->show($resource->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resource = Product::findOrFail($id);
        $resource->destroy($id);
        return null;
    }
}
