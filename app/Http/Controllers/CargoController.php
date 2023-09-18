<?php

namespace App\Http\Controllers;

use App\Http\Requests\CargoRequest;
use App\Models\Cargo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $offcet = $request->input('offset', 0);
        $limit = $request->input('limit', 10);

        $cargos = Cargo::offset($offcet)->limit($limit)->get();

        return response()->json($cargos);
    }

    public function store(CargoRequest $request): JsonResponse
    {
        $cargo = Cargo::create($request->validated());

        return response()->json($cargo, 201);
    }

    public function update(CargoRequest $request, Cargo $cargo): JsonResponse
    {
        $cargo->update($request->validated());
        
        return response()->json($cargo);
    }

    public function show(Cargo $cargo): JsonResponse
    {
        return response()->json($cargo);
    }
}
