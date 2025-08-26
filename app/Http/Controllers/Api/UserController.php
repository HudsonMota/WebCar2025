<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Retorna os dados do usuário autenticado.
     */
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }
}
