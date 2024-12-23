<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users      = User::with('roles')->paginate();
        $i          = ($request->input('page', 1) - 1) * $users->perPage();

        return view('admin.user.index', compact('users', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $payload = $request
            ->safe()
            ->merge(['password' => User::$default_password])
            ->all();

        $user = User::create($payload);
        $user->assignRole($request->role);

        return Redirect::route('admin.users.index')
                        ->with('message', 'New user has been successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($user_id)
    {
        $user = User::with('roles')->findOrFail($user_id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $payload = $request->validated();

        $user->update($payload);
        $user->syncRoles($request->role);

        return Redirect::route('admin.users.index')
                        ->with('message', 'User has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->hasRole(RoleEnum::ADMIN)) {
            return abort(403);
        }

        $user->delete();

        return Redirect::route('admin.users.index')
                        ->with('message', 'User has been successfully deleted!');
    }
}
