<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\OrderStore;
use App\Http\Requests\Order\OrderUpdate;
use App\Models\Order;
use App\Services\OrderService;


class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     * @OA\Get(
     *      path="/api/order",
     *      operationId="OrderIndex",
     *      tags={"Order"},
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
        $resources = Order::with('products', 'client')->get();
        return response($resources->toJSON(), 200);
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *      path="/api/order",
     *      operationId="OrderStore",
     *      tags={"Order"},
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
     *         request="OrderStoreRequest",
     *         description="OrderStoreRequest",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/OrderStoreRequest")
     *       ),
     *     )
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStore $request, Order $resource)
    {
        $resource = $resource->create($request->all());

        $resource->products()->sync($request->products);
        return $this->show($resource->id);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
     *      path="/api/order/{id}",
     *      operationId="OrderShow",
     *      tags={"Order"},
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
        $resource = Order::with('products', 'client')->findOrFail($id);
        return response($resource->toJson(), 200);
    }

    /**
     * Update the specified resource in storage.
     * @OA\Put(
     *      path="/api/order/{id}",
     *      operationId="OrderUpdate",
     *      tags={"Order"},
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
     *         request="OrderUpdateRequest",
     *         description="OrderUpdateRequest",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/OrderUpdateRequest")
     *       ),
     *     )
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdate $request, $id)
    {
        $resource = Order::findOrFail($id);
        $resource->fill($request->all())->save();
        $resource->products()->sync($request->products);
        return $this->show($resource->id);
    }

    /**
     * Remove the specified resource from storage.
     * @OA\Delete(
     *      path="/api/order/{id}",
     *      operationId="OrderDelete",
     *      tags={"Order"},
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
        $resource = Order::findOrFail($id);
        $resource->destroy($id);
        return null;
    }

}
