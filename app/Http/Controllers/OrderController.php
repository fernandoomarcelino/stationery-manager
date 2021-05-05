<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\OrderStore;
use App\Http\Requests\Order\OrderUpdate;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Order::with('products','client')->get();
        return response($resources->toJSON(), 200);
    }

    /**
     * @param Request $request
     * @param Order $resource
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
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resource = Order::with('products','client')->findOrFail($id);
        return response($resource->toJson(), 200);
    }

    /**
     * Update the specified resource in storage.
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
     *
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
