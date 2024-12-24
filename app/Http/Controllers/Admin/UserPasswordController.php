<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class UserPasswordController extends Controller
{
    public function update(User $user) {
        $user->update(['password' => User::$default_password]);

        return Redirect::route('admin.users.index')
                        ->with('message', 'The user\'s password has been successfully reset!');
    }
}
