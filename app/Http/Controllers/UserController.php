<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Business\AbilitiesResolver;

class UserController extends Controller
{
    public function index()
    {
        AbilitiesResolver::autorize('users.index');
        $users = User::paginate(10);
        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        AbilitiesResolver::autorize('users.show');
        return new UserResource($user);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return new UserResource($user);
    }

    public function update(User $user, Request $request)
    {
        AbilitiesResolver::autorize('users.update');
        $user->update($request->all());
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        AbilitiesResolver::autorize('users.destroy');
        $user->delete();
        return new UserResource($user);
    }
}
