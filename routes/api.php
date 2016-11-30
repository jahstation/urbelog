<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');
        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');
    });

    $api->group(['middleware' => 'jwt.auth'], function ($api) {
        $api->post('ztl/save', 'App\Api\V1\Controllers\ZtlController@store');
        $api->get('ztl', 'App\Api\V1\Controllers\ZtlController@index');
        $api->get('ztl/{id}', 'App\Api\V1\Controllers\ZtlController@show');
        $api->put('ztl/{id}', 'App\Api\V1\Controllers\ZtlController@update');
        $api->delete('ztl/{id}', 'App\Api\V1\Controllers\ZtlController@destroy');
    });

    $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
        $api->get('protected', function() {
            return response()->json([
                'message' => 'Access to this item is only for authenticated user. Provide a token in your request!'
            ]);
        });

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);
    });

    $api->get('hello', function() {
        return response()->json([
            'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });
});


/*
 *
 * <?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

	$api->post('auth/login', 'App\Api\V1\Controllers\AuthController@login');
	$api->post('auth/signup', 'App\Api\V1\Controllers\AuthController@signup');
	$api->post('auth/recovery', 'App\Api\V1\Controllers\AuthController@recovery');
	$api->post('auth/reset', 'App\Api\V1\Controllers\AuthController@reset');

	// example of protected route
	$api->get('protected', ['middleware' => ['api.auth'], function () {
		return \App\User::all();
    }]);

	// example of free route
	$api->get('free', function() {
		return \App\User::all();
	});



	$api->group(['middleware' => 'api.auth'], function ($api) {
		$api->post('ztl/save', 'App\Api\V1\Controllers\ZtlController@store');
		$api->get('ztl', 'App\Api\V1\Controllers\ZtlController@index');
		$api->get('ztl/{id}', 'App\Api\V1\Controllers\ZtlController@show');
		$api->put('ztl/{id}', 'App\Api\V1\Controllers\ZtlController@update');
		$api->delete('ztl/{id}', 'App\Api\V1\Controllers\ZtlController@destroy');
	});

	$api->group(['middleware' => 'api.auth'], function ($api) {
		$api->post('vehicle/save', 'App\Api\V1\Controllers\VehicleController@store');
		$api->get('vehicle', 'App\Api\V1\Controllers\VehicleController@index');
		$api->get('vehicle/{id}', 'App\Api\V1\Controllers\VehicleController@show');
		$api->put('vehicle/{id}', 'App\Api\V1\Controllers\VehicleController@update');
		$api->delete('vehicle/{id}', 'App\Api\V1\Controllers\VehicleController@destroy');
	});

	$api->group(['middleware' => 'api.auth'], function ($api) {
		$api->post('trip/save', 'App\Api\V1\Controllers\TripController@store');
		$api->get('trip', 'App\Api\V1\Controllers\TripController@index');
		$api->get('trip/{id}', 'App\Api\V1\Controllers\TripController@show');
		$api->put('trip/{id}', 'App\Api\V1\Controllers\TripController@update');
		$api->delete('trip/{id}', 'App\Api\V1\Controllers\TripController@destroy');
	});

});



 */
