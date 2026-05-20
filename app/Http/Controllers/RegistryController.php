<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistryController extends Controller
{
    protected $services = [];
    public function register_app(Request $request) {

        dd('services');
        $services[$request->name] = [
            'name' => $request->name,
            'project' => $request->project,
            'url' => $request->url,
            'last_seen' => time(),
            'status' => 'Online'
        ];

        return response()->json([
            'message' => 'Registered'
        ]);
    }
}
