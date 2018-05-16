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
    $users = \DB::table('User')->get();
    return $users;
});

Route::get('isUserCitizen', function (Request $r) {
    $users = \DB::table('User')
                  ->where('UserType', '=' ,'Citizen')
                  ->get();

    return $users;
});

Route::get('services/categories/{cityhallid}', function ($cityhallid) {
    $categories = \DB::select("SELECT Service.ServiceName, Service.ServiceID, Category.CategoryName, Category.CategoryID
                              FROM CityHall
                              INNER JOIN CityHallService
                              	ON CityHall.CityHallID = CityHallService.CityHallID
                              INNER JOIN Service
                              	ON CityHallService.ServiceID = Service.ServiceID
                              INNER JOIN Category
                              	ON Category.CategoryID = Service.CategoryID
                              WHERE CityHall.CityHallID =".$cityhallid);

    return $categories;
});

Route::get('cityhall/isCity/{cityname}', function ($cityname) {
    $city = \DB::table('CityHall')
                        ->select('CityHall.CityName')
                        ->where('CityHall.CityName', 'LIKE', $cityname)
                        ->get();
    return $city;
});
