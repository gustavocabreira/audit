<?php

use App\Models\GpsAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('gps-attachments', function (Request $request) {
    $file = $request->file('file');
    $name = $file->getFilename();
    $content = base64_encode($file->getContent());
    $path = $file->getPath();

    for ($i = 0; $i <= 10; $i++) {
        GpsAttachment::query()->create([
            'name' => $name,
            'path' => $path,
            'content' => $content,
        ]);
    }

    echo 'success';
});

Route::get('gps-attachments', function () {
    return [
        'old' => GpsAttachment::all(),
    ];
    
    return GpsAttachment::all();
});
