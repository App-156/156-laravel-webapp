<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', function (Request $r) {
    $users = \DB::table('users')->get();
    return $users;
});

Route::get('isUserCitizen', function (Request $r) {
    $users = \DB::table('users')->where('type', '=' ,'Citizen')->get();
    return $users;
});

Route::get('services/categories/{cityhallid}', function ($cityhallid) {
    $categories = \DB::table('cityhallservice')
                        ->where('cityhall_id', '=', $cityhallid)
                        ->get();
    return $categories;
});

Route::get('services/categories', function (Request $r) {
    $categories = \DB::table('categories')->get();
    return $categories;
});
