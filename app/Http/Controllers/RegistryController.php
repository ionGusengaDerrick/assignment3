<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistryController extends Controller
{
    public function register_app(Request $request)
    {
        return response()->json([
            'message' => 'Use POST /register in routes/web.php',
        ]);
    }
}
