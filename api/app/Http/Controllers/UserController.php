<?php

namespace App\Http\Controllers;

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
        $users = User::paginate(9);
        $response = [
            "users" => UserResource::collection($users),
            'links' => [
                'first' => Helper::getParams($users->url(1))["page"] ?? null,
                'last' => Helper::getParams($users->url($users->lastPage()))["page"] ?? null,
                'prev' => Helper::getParams($users->previousPageUrl())["page"] ?? null,
                'next' => Helper::getParams($users->nextPageUrl())["page"] ?? null,
            ],
        ];
        return $this->sendResponse($response, 'Get All Users');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();

        $slug = Helper::generateSlug("u", "users");
        $user = User::create([
            "slug" => $slug,
            "isActive" => 1,
            ...$validated
        ]);

        return $this->sendResponse(new UserResource($user), "User Successfully Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->sendResponse(new UserResource($user), 'Get a User');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $validated = $request->validated();
        $slug = $user->slug;

        if ($validated["name"] != $user->name) {
            $slug = Helper::generateSlug("u", "users");
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
        return $this->sendResponse(new UserResource($user), "User Successfully Deleted");
    }
}
