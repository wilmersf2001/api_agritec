<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use App\Utils\Constants;

class ProductController extends Controller
{
    private function uploadImage($file, string $name, string $destination)
    {
        if ($file) {
            $filename = $name . '.' . $file->getClientOriginalExtension();
            Storage::disk(Constants::DISK_STORAGE)->put($destination . $filename, file_get_contents($file));
        }
    }

    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $imagen = $request->file('foto_producto');
        $ruta_imagen = 'http://127.0.0.1:8000/storage/db_robots/' . $request->nombre . '.' . $imagen->getClientOriginalExtension();

        $product = Product::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'ruta_imagen' => $ruta_imagen,
            'user_id' => $request->user_id,
            'category_id' =>  $request->category_id,
        ]);

        $this->uploadImage($request->file('foto_producto'), $product->id, Constants::RUTA_FOTO);

        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        $product->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'user_id' => $request->user_id,
            'category_id' =>  $request->category_id,
        ]);

        $this->uploadImage($request->file('foto_producto'), $product->id, Constants::RUTA_FOTO);

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return new ProductResource($product);
    }
}
