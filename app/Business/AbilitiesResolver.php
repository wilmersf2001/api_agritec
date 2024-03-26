<?php

namespace App\Business;

use Illuminate\Support\Facades\Auth;

class AbilitiesResolver
{
  public static function resolve($user)
  {
    if ($user->role === 'admin') {
      return [
        'users.index',
        'users.show',
        'users.store',
        'users.update',
        'users.destroy',
        'categories.store',
        'categories.update',
        'categories.destroy',
        'products.store',
        'products.update',
        'products.destroy',
        'cart.index',
        'cart.store',
        'cart.update',
        'cart.destroy',
        'orders.index',
        'orders.store',
      ];
    } else {
      return [
        'users.show',
        'users.store',
        'users.update',
        'cart.index',
        'cart.store',
        'cart.update',
        'cart.destroy',
        'orders.index',
        'orders.store',
      ];
    }
  }

  public static function autorize($ability)
  {
    return abort_unless(
      Auth::user()->tokenCan($ability),
      403,
      'No cuenta con permisos para realizar esta acción'
    );
  }
}
