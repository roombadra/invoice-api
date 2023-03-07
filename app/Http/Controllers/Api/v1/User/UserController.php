<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Models\User;
use App\Models\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\User\UserRessource;
use App\Http\Requests\Api\v1\User\UserStoreRequest;
use App\Http\Requests\Api\v1\User\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = UserRessource::collection(User::all());
        return ApiResponse::success($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $request['password'] = bcrypt($request['password']);
        $user = User::create($request->all());
        return ApiResponse::success($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return ApiResponse::success(UserRessource::make($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        if ($request->has('password'))
            $request['password'] = bcrypt($request['password']);
        if (User::where('email', $request->email)->exists()) {
            $user->update($request->except('email'));
            return ApiResponse::success(UserRessource::make($user));
        }
        $user->update($request->validated());
        return ApiResponse::success(UserRessource::make($user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return ApiResponse::success(['message' => 'User deleted successfully']);
    }
}