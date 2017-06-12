<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WsController extends Controller
{
    public function checkAuth()
    {
        return response()->json([
            'auth' => true
        ]);
    }
}
