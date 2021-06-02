<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user->profile->first_name;
    }
}
