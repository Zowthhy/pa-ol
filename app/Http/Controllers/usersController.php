<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class usersController extends Controller
{

    public function buscar(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('name', 'like', "%{$search}%")->limit(10)->get();
    
        return response()->json($users);
    }


}
