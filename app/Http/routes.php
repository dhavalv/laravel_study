<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('welcome');
});
Route::get('calender', function () {
    $event = \MaddHatter\LaravelFullcalendar\Calendar::event(
            "Valentine's Day", //event title
            true, //full day event?
            '2015-02-14', //start time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg)
            '2015-02-14', //end time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg),
        1, //optional event ID
        [
            'url' => 'http://full-calendar.io'
        ]
    );
//    echo '<pre>';
  //  print_r($event);
   // die;
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

//Custom login and static

/*Route::get('/',function(){
    return 'login here';
});
route::get('/home',function(){
    return 'login successfully';
});

Route::group(['middleware'=>'web'],function(){
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('getToken',function(){
        $token = request()->session()->get('_token');
        return $token;
    });
});
Route::get('logout', 'Auth\AuthController@getLogout');*/



Route::group(['prefix' => 'api/v1','middleware'=>'web'],function(){
    /*
     * login here: pass rememberToken
{
    email: ":email",
    password: ":pass",
    _token: ":token"
}
    @return key: SwVKfeyZChGL2bON4AtHHeZLwCPStwggueNN5zWB
     * */
    Route::get('getToken',['uses'=>'ApiController@getToken']);
    Route::post('auth/login',['uses'=>'ApiController@doLogin']);
    Route::get('auth/logout',['uses' => 'ApiController@doLogout']);

    Route::group(['middleware' => 'auth'],function(){
        Route::get('users',['uses'=>"ApiController@getUsers"]);
        Route::post('users',['uses' => 'ApiController@storeUser']);
    });

    
    /*Route::post('auth/login',function(){
        $email = request()->get('email');
        $password = request()->get('password');
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            return 'login';
        }else{
            return 'not login';
        }
    });*/
   /* Route::get('test',function(){
        return response([
            'responseData' => [
                'queryString' => null,
                'resultData' => "fetch data"
            ],
            'message' => 'This is message sending successfully again!',
            'responseStatus' => 201
        ]);
    });*/
});
//https://www.paypal.com/in/cgi-bin/merchantpaymentweb?cmd=_flow&SESSION=4L2PwjZp1CKLm-5Fq3mMEzDv_wS5Cyr1rFV0X0aFquHQLQXS-sWAM7irktK&dispatch=50a222a57771920b6a3d7b606239e4d529b525e0b7e69bf0224adecfb0124e9b61f737ba21b081984719ecfa9a8ffe80733a1a700ced90ae

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
