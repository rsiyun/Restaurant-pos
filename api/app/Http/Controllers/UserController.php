<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use App\Helpers\Helper;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return $this->sendError('Users do not exist.');
        }

        return $this->sendResponse(UserResource::collection($users), 'Get All Users');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();

        $slug = Helper::generateSlug($validated["name"], "users");
        $user = User::create([
            "slug" => $slug,
            "isActive" => 1,
            ...$validated
        ]);

        return $this->sendResponse(new UserResource($user), "users Berhasil DiTambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $user = User::where('slug', $slug)->first();

        if (is_null($user)) {
            return $this->sendError('User does not exist.');
        }

        return $this->sendResponse(new UserResource($user), 'User fetched.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $validated = $request->validated();
        $slug = $user->slug;

        if ($validated["name"] != $user->name) {
            $slug = Helper::generateSlug($validated["name"], "users");
        }

        $user->update([
            "slug" => $slug,
            ...$validated
        ]);

        return $this->sendResponse(new UserResource($user), "User Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->sendResponse(new UserResource($user), "Shop Berhasil DiHapus");
    }
}
