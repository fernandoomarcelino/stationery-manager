<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\ClientStore;
use App\Http\Requests\Client\ClientUpdate;
use App\Models\Client;
use App\Services\ClientService;

class ClientController extends Controller
{
    protected ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of the resource.
     * @OA\Get(
     *      path="/api/client",
     *      operationId="ClientIndex",
     *      tags={"Client"},
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
        $resources = Client::all();
        return response($resources->toJSON(), 200);
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *      path="/api/client",
     *      operationId="ClientStore",
     *      tags={"Client"},
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
     *         request="ClientStoreRequest",
     *         description="ClientStoreRequest",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ClientStoreRequest")
     *       ),
     *     )
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStore $request, Client $resource)
    {
        $resource = $resource->create($request->all());
        return $this->show($resource->id);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
     *      path="/api/client/{id}",
     *      operationId="ClientShow",
     *      tags={"Client"},
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
        $resource = Client::findOrFail($id);
        return response($resource->toJson(), 200);
    }

    /**
     * Update the specified resource in storage.
     * @OA\Put(
     *      path="/api/client/{id}",
     *      operationId="ClientUpdate",
     *      tags={"Client"},
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
     *         request="ClientUpdateRequest",
     *         description="ClientUpdateRequest",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ClientUpdateRequest")
     *       ),
     *     )
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdate $request, $id)
    {
        $resource = Client::findOrFail($id);
        $resource->fill($request->all())->save();
        return $this->show($resource->id);
    }

    /**
     * Remove the specified resource from storage.
     * @OA\Delete(
     *      path="/api/client/{id}",
     *      operationId="ClientDelete",
     *      tags={"Client"},
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
        $resource = Client::findOrFail($id);
        $resource->destroy($id);
        return null;
    }
}
