<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'cantidad' => $this->cantidad,
            'ruta_imagen' => $this->ruta_imagen,
            'ruta_factura' => $this->ruta_factura,
            'usuario' => new UserResource($this->user),
            'category' => new CategoryResource($this->category),
            'created_at' => $this->created_at,
        ];
    }
}
