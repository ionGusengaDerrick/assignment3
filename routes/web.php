<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Cache::forget('services');

    return view('dashboard');
});

Route::post('/register', function (Request $request) {

    $services = Cache::get('services', []);

    $services[$request->name] = [
        'name' => $request->name,
        'project' => $request->project,
        'url' => $request->url,
        'last_seen' => time(),
        'status' => 'Online'
    ];

    Cache::put('services', $services);

    return response()->json([
        'message' => 'registered'
    ]);
});

Route::post('/ping', function (Request $request) {

    $services = Cache::get('services', []);

    if (isset($services[$request->name])) {

        $services[$request->name]['last_seen'] = time();

        Cache::put('services', $services);
    }

    return response()->json([
        'message' => 'ping received'
    ]);
});

Route::get('/services', function () {

    $services = Cache::get('services', []);

    $now = time();

    foreach ($services as $key => $service) {

        if (($now - $service['last_seen']) > 10) {

            $services[$key]['status'] = 'Offline';

        } else {

            $services[$key]['status'] = 'Online';
        }
    }

    Cache::put('services', $services);

    return response()->json($services);
});
