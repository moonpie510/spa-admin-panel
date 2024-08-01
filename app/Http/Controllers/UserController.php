<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        User::create($data);
        return response()->json(['message' => 'Пользователь создан'], 200);
    }
}
