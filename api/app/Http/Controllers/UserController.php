<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController;
use App\Http\Resources\User as UserResource;
use App\Models\User;

class UserController extends BaseController
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

        return $this->sendResponse('User', UserResource::collection($users), 'Users fetched.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'idShop' => 'required',
            // 'slug' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'isActive' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = User::create($request->all());

        return $this->sendPost('User', new UserResource($user), 'Post Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User does not exist.');
        }

        return $this->sendGetData('User', new UserResource($user), 'User fetched.');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'isActive' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User does not exist.');
        }

        $user->update($input);

        return $this->sendUpdate('User ', new UserResource($user), 'User updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User does not exist.');
        }

        $user->delete();

        return $this->sendDelete('User ', new UserResource($user), 'User deleted.');
    }
}
