<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LocationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/users', [UserController::class, 'store']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/products-random', [ProductController::class, 'getProductsRandom']);
Route::get('/products-search', [ProductController::class, 'search']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/categories/{category}/products', [CategoryController::class, 'products']);

Route::get('/departamentos', [LocationController::class, 'getDepartamentos']);
Route::get('/departamentos/{departamento}/provincias', [LocationController::class, 'getProvinciasByDepartamento']);
Route::get('/provincias/{provincia}/distritos', [LocationController::class, 'getDistritosByProvincia']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    //RUTAS USUARIOS
    Route::get('/user-logged', [AuthController::class, 'getLoggedInUser']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    /* Route::apiResource('users', 'UserController'); */
    //RUTAS CATEGORIAS
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
    //RUTAS PRODUCTOS
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    //RUTAS CARRITO
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/{product}', [CartController::class, 'store']);
    Route::put('/cart/{rowId}', [CartController::class, 'update']);
    Route::delete('/cart/{rowId}', [CartController::class, 'destroy']);
    Route::get('/cart-total', [CartController::class, 'totalCart']);
    //RUTAS ORDENES
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
