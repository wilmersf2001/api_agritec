<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Business\AbilitiesResolver;
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
        AbilitiesResolver::autorize('products.store');
        $imagen_producto = $request->file('foto_producto');
        $imagen_factura = $request->file('foto_factura');

        $product = Product::create([
            'codigo' => 'PRD' . time(), // 'PRD' . time() . rand(1, 1000) . 'PRD
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'ruta_imagen' => "",
            'ruta_factura' => "",
            'user_id' => $request->user_id,
            'category_id' =>  $request->category_id,
        ]);

        $ruta_imagen_producto = 'http://127.0.0.1:8000/storage/db_robots/' . $product->id . '.' . $imagen_producto->getClientOriginalExtension();

        if ($imagen_factura) {
            $ruta_imagen_factura = 'http://127.0.0.1:8000/storage/db_facturas/' . $product->id . '.' . $imagen_factura->getClientOriginalExtension();
            $product->update([
                'ruta_imagen' => $ruta_imagen_producto,
                'ruta_factura' => $ruta_imagen_factura,
            ]);
        } else {
            $product->update([
                'ruta_imagen' => $ruta_imagen_producto,
            ]);
        }

        $this->uploadImage($request->file('foto_producto'), $product->id, Constants::RUTA_FOTO);
        $this->uploadImage($request->file('foto_factura'), $product->id, Constants::RUTA_FACTURA);

        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        AbilitiesResolver::autorize('products.update');
        $imagen_producto = $request->file('foto_producto');
        $imagen_factura = $request->file('foto_factura');
        $product->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'user_id' => $request->user_id,
            'category_id' =>  $request->category_id,
        ]);

        $ruta_imagen_producto = 'http://127.0.0.1:8000/storage/db_robots/' . $product->id . '.' . $imagen_producto->getClientOriginalExtension();

        if ($imagen_factura) {
            $ruta_imagen_factura = 'http://127.0.0.1:8000/storage/db_facturas/' . $product->id . '.' . $imagen_factura->getClientOriginalExtension();
            $product->update([
                'ruta_imagen' => $ruta_imagen_producto,
                'ruta_factura' => $ruta_imagen_factura,
            ]);
        } else {
            $product->update([
                'ruta_imagen' => $ruta_imagen_producto,
            ]);
        }

        $this->uploadImage($request->file('foto_producto'), $product->id, Constants::RUTA_FOTO);
        $this->uploadImage($request->file('foto_factura'), $product->id, Constants::RUTA_FACTURA);

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        AbilitiesResolver::autorize('products.destroy');
        $product->delete();
        return new ProductResource($product);
    }

    public function getProductsRandom()
    {
        $productos = Product::inRandomOrder()->take(10)->get();
        return ProductResource::collection($productos);
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $productos = Product::where('codigo', 'like', '%' . $searchQuery . '%')
            ->orWhere('nombre', 'like', '%' . $searchQuery . '%')
            ->get();
        return ProductResource::collection($productos);
    }
}
