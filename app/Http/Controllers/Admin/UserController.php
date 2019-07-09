<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UserRequest $request
     *
     * @return UserResource
     */
    public function index(UserRequest $request)
    {
        $users = User::withCount('articles')
            ->when($name = $request->get('name'), function ($query) use ($name) {
                $query->where('name', 'like', '%'.$name.'%');
            })
            ->paginate($request->get('per_page', 10));

        return new UserResource($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     *
     * @return JsonResponse
     */
    public function store(UserRequest $request)
    {
        $data = array_merge($request->all(), [
            'password' => Hash::make($request->get('password')),
        ]);

        $user = User::create($data);

        $response = [
            'message' => 'User created.',
            'data'    => new UserResource($user),
        ];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return UserResource
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function profile()
    {
        $user = Auth::guard('jwt')->user();
        $user->roles = ['admin'];

        return response()->json([
            'data' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int         $id
     *
     * @return JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = array_merge($request->all(), [
            'password' => Hash::make($request->get('password')),
        ]);
        $user->fill($data);
        $user->save();
        $response = [
            'message' => 'User updated.',
            'data'    => $user->toArray(),
        ];

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string|int $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if (is_string($id)) {
            $id = explode(',', $id);
        }

        User::destroy($id);

        return response()->json([
            'message' => 'Delete success',
        ]);
    }
}
