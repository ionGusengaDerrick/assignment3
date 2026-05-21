<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
    Cache::forget('services');
    return view('dashboard');
}); 

Route::post('/ping', function (Request $request) {

    //validate request
    $request->validate([
        'name' => 'required|string',
        'project_name' => 'required|string',
        'url' => 'required|string',
    ]);

     // get existing services from cache
     $services = Cache::get('services', []);

     $name = $request->name; 

     // create/update service
    $services[$name] = [
        'name' => $request->name,
        'project_name' => $request->project_name,
        'url' => $request->url,
        'last_seen' => time(),
        'status' => 'online',
    ];

     // save globally
     Cache::put('services', $services);

    // log current services
    // Log::info('services', ['services' => $services]);

    return response()->json([
        'message' => 'Ping received',
    ]);

});

Route::get('/services', function () {

    // get existing services from cache
    $services = Cache::get('services', []);
    $now = time();

    foreach ($services as $key => $service) {
        $services[$key]['status'] =
            ($now - $service['last_seen']) > 5
            ? 'offline'
            : 'online';
    }

    return response()->json([
        'services' => array_values($services)
    ]);
});
