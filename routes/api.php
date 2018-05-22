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

Route::get('requests/byCitizen/{citizenid}', function ($cityzenid) {
    $requests = \DB::table('Request')
                        ->where('Request.CitizenID', '=', $cityzenid)
                        ->get();
    return $requests;
});

Route::post('users/newUser', function (Request $r) {
  $userid = 0;
  $citizenid = 0;
  $userlogin = "";
  $userpassword = "";
  $useremail = "";
  $usertype = "";
  $citizenname = "";
  $citizencpf = "";
  $citizencellphone = "";

  if($r->input("UserID") !== null) {
    $userid = $r->input('UserID');
  }

  if($r->input("UserLogin") !== null) {
    $userlogin = $r->input('UserLogin');
  }

  if($r->input("UserPassword") !== null) {
    $userpassword = $r->input('UserPassword');
  }

  if($r->input("UserEmail") !== null) {
    $useremail = $r->input('UserEmail');
  }

  if($r->input("UserType") !== null) {
    $usertype = $r->input('UserType');
  }

  if($r->input("CitizenCPF") !== null) {
    $citizencpf = $r->input('CitizenCPF');
  }

  if($r->input("CitizenName") !== null) {
    $citizenname = $r->input('CitizenName');
  }

  if($r->input("CitizenCellphone") !== null) {
    $citizencellphone = $r->input('CitizenCellphone');
  }

  $userid = \DB::table('User')->insertGetId(
    [
      'UserLogin' => $userlogin,
      'UserPassword' => $userpassword,
      'UserEmail' => $useremail,
      'UserType' => $usertype
    ]
  );

  $citizenid = \DB::table('Citizen')->insertGetId(
    [
      'UserID' => $userid,
      'CitizenCPF' => $citizencpf,
      'CitizenName' => $citizenname,
      'CitizenCellphone' => $citizencellphone
    ]
  );

  return $userid;
});

Route::post('requests/newRequest', function (Request $r) {
    $requestid = 0;
    $cityhallserviceid = 0;
    $citizenid = 0;
    $requestdescription = null;
    $requestdate = null;
    $requestimagedirectory = null;
    $requeststatus = null;
    $requestlongitude = null;
    $requestlatitude = null;
    $requestaddress = null;

    if($r->input("RequestID") !== null) {
      $requestid = $r->input('RequestID');
    }

    if($r->input("CityHallServiceID") !== null) {
      $cityhallserviceid = $r->input("CityHallServiceID");
    }

    if($r->input('CitizenID') !== null) {
      $citizenid = $r->input('CitizenID');
    }

    if($r->input('RequestDescription') !== null) {
      $requestdescription = $r->input('RequestDescription');
    }

    if($r->input('RequestDate') !== null) {
      $requestdate = $r->input('RequestDate');
    }

    if($r->input('RequestImageDirectory') !== null) {
      $requestimagedirectory = $r->input('RequestImageDirectory');
    }

    if($r->input('RequestStatus') !== null) {
      $requeststatus = $r->input('RequestStatus');
    }

    if($r->input('RequestLongitude') !== null) {
      $requestlongitude = $r->input('RequestLongitude');
    }

    if($r->input('RequestLatitude') !== null) {
      $requestlatitude = $r->input('RequestLatitude');
    }

    if($r->input('Address') !== null) {
      $requestaddress = $r->input('Address');
    }

    $id = \DB::table('Request')->insertGetId([
      ['RequestID' => $requestid,
      'CityHallServiceID' => $cityhallserviceid,
      'CitizenID' => $citizenid,
      'RequestDescription' => $requestdescription,
      'RequestDate' => $requestdate,
      'RequestImageDirectory' => $requestimagedirectory,
      'RequestStatus' => $requeststatus,
      'RequestResponse' => "",
      'RequestLatitude' => $requestlatitude,
      'RequestLongitude' => $requestlongitude,
      'RequestAddress' => $requestaddress]
     ]);

    return $id;
});
