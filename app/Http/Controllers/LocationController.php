<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\LocationResource;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;

class LocationController extends Controller
{
    public function getDepartamentos()
    {
        $departamentos = Cache::remember("departamentos", 60, function () {
            return Departamento::all();
        });
        return LocationResource::collection($departamentos);
    }

    public function getProvinciasByDepartamento(Departamento $departamento)
    {
        $provincias = $departamento->provincias;
        return LocationResource::collection($provincias);
    }

    public function getDistritosByProvincia(Provincia $provincia)
    {
        $distritos = $provincia->distritos;
        return LocationResource::collection($distritos);
    }
}
