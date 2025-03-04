<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContragentRequest;
use App\Http\Resources\ContragentResource;
use App\Models\Contragent;

class ContragentController extends Controller
{
    public function index()
    {
        return ContragentResource::collection(Contragent::all());
    }

    public function store(ContragentRequest $request)
    {
        return new ContragentResource(Contragent::create($request->validated()));
    }

    public function show(Contragent $contragent)
    {
        return new ContragentResource($contragent);
    }

    public function update(ContragentRequest $request, Contragent $contragent)
    {
        $contragent->update($request->validated());

        return new ContragentResource($contragent);
    }

    public function destroy(Contragent $contragent)
    {
        $contragent->delete();

        return response()->json();
    }
}
