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
     * @OA\Get(
     *      path="/api/product",
     *      operationId="ProductIndex",
     *      tags={"Product"},
     *      summary="Show all",
     *      description="Show all",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request", @OA\JsonContent()),
     *      @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *      @OA\Response(response=404, description="Resource Not Found", @OA\JsonContent())
     * )
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
     * @OA\Post(
     *      path="/api/product",
     *      operationId="ProductStore",
     *      tags={"Product"},
     *      summary="Create",
     *      description="Create",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent()
     *       ),
     *       @OA\Response(response=400, description="Bad Request", @OA\JsonContent()),
     *       @OA\Response(response=422, description="Missing parameters (validation)", @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse")),
     *       @OA\RequestBody(
     *         request="ProductStoreRequest",
     *         description="ProductStoreRequest",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductStoreRequest")
     *       ),
     *     )
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
     * @OA\Get(
     *      path="/api/product/{id}",
     *      operationId="ProductShow",
     *      tags={"Product"},
     *      summary="Show detail",
     *      description="Show detail",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request", @OA\JsonContent()),
     *      @OA\Response(response=404, description="Resource Not Found", @OA\JsonContent())
     * )
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
     * @OA\Put(
     *      path="/api/product/{id}",
     *      operationId="ProductUpdate",
     *      tags={"Product"},
     *      summary="Update",
     *      description="Update",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad Request", @OA\JsonContent()),
     *       @OA\Response(response=422, description="Missing parameters (validation)", @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse")),
     *       @OA\RequestBody(
     *         request="ProductUpdateRequest",
     *         description="ProductUpdateRequest",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductUpdateRequest")
     *       ),
     *     )
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
     * @OA\Delete(
     *      path="/api/product/{id}",
     *      operationId="ProductDelete",
     *      tags={"Product"},
     *      summary="Remove",
     *      description="Remove",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request", @OA\JsonContent()),
     *      @OA\Response(response=404, description="Resource Not Found", @OA\JsonContent())
     * )
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
