<?php

namespace App\Http\Controllers;

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
}
