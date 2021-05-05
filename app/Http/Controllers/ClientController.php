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
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resource = Client::findOrFail($id);
        return response($resource->toJson(), 200);
    }

    /**
     * @param ClientUpdate $request
     * @param $id
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
     *
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
