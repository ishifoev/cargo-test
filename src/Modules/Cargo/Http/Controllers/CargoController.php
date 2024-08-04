<?php

declare(strict_types=1);

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Entities\Cargo;
use Modules\Cargo\DTOs\TruckDto;

class CargoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $limit = $request->input('limit', 10);
        $offset = $request->input('offset', 0);
        $cargos = Cargo::query()->offset($offset)->limit($limit)->get();
        return response()->json($cargos);
    }

    public function store(Request $request): JsonResponse
    {
        $truckDto = new TruckDto($request->input('truck'));
        $cargo = Cargo::create([
            'weight' => $request->input('weight'),
            'volume' => $request->input('volume'),
            'truck' => $truckDto,
        ]);

        return response()->json($cargo, 201);
    }

    public function show(int $id): JsonResponse
    {
        $cargo = Cargo::findOrFail($id);
        return response()->json($cargo);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $cargo = Cargo::findOrFail($id);
        $truckDto = new TruckDto($request->input('truck'));
        $cargo->update([
            'weight' => $request->input('weight'),
            'volume' => $request->input('volume'),
            'truck' => $truckDto,
        ]);

        return response()->json($cargo);
    }
}
