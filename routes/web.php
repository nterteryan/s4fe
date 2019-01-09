<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return response()->json([
        'content' => 'SAFE Rest API',
        'version' => '1.0.0'
    ]);
});

$router->get('/docs', function () {
    return storage_path('/api-docs');
});

/*$router->get('/apple-app-site-association', function () {
	$name = 'apple-app-site-association.json';
	$pathToFile = storage_path($name);
	return json_decode(file_get_contents($pathToFile),true);
});*/

$router->get('/docs', function () {
    return storage_path('/api-docs');
});

$router->get('/api/docs[/{doc}]', function ($doc=false) {
    if(!$doc)
        return view("api-docs/docs-map");
    return view("api-docs/".$doc);
});

$router->group(['prefix' => '/img'], function () use ($router) {
    $router->get('/items/{photo}', function ($photo) {
        return \App\Service\FileService::getResponse('/uploads/item/' . $photo);
    });
});

// Public endpoints
$router->post('/send-verification-sms', 'AuthController@sendVerificationSms');
$router->get('/phone/verify/{hash}', 'AuthController@phone_verify_hash');
$router->post('/register', 'AuthController@register');
$router->post('/authenticate', 'AuthController@getPersonalAccessToken');

$router->post('/signup-forward/{email}', 'AuthController@signup_forward');
$router->get('/user/email/verify/{hash}' , 'AuthController@email_verify_hash');
$router->post('/user/password', 'AuthController@password');

$router->post('reset-password' , 'AuthController@reset_password');
$router->get('user/reset-password-by-hash/{hash}'  , 'AuthController@reset_password_by_hash');

$router->group(['middleware' => 'throttle'], function ($router) {
    $router->get('/search/items/{query}[/{filters}]', 'SearchController@search');
});

// All routes required authentication goes here
$router->group(['middleware' => 'auth:api'], function ($router) {
    $router->post('/me', function (\Illuminate\Http\Request $request) {
        $transformer = new \App\Transformer\User\UserMeTransformer;
        return response()->json($transformer->transform($request->user()));
    });

    $router->put('/user', 'UserController@update');
    $router->post('/users/wallet', 'UserController@wallet');
    $router->post('/users/linkWallet', 'UserController@linkWallet');
    $router->get('/item-statuses', 'ItemController@getStatuses');
    $router->get('/items', 'ItemController@index');
    $router->get('/items/reported' , 'ItemController@reported');
    $router->get('/items/founded'  , 'ItemController@founded');
    $router->post('/items', 'ItemController@store');
    $router->patch('/items/{id}', 'ItemController@patch');
    $router->put('/items/{id}', 'ItemController@put');
    $router->get('/items/{id}', 'ItemController@one');
    $router->delete('/items/{id}', 'ItemController@delete');
    $router->delete('/items/delete-file/{item_id}/{file_name}', 'ItemController@delete_file');

    $router->get('/item/report-statuses', 'ItemReportController@getStatuses');
    $router->get('/item/{id}/reports', 'ItemReportController@index');
    $router->post('/item/{id}/reports', 'ItemReportController@store');

    $router->get('/reports/{id}', 'ItemReportController@one');

    $router->get('/report/{id}/comments', 'ItemReportCommentController@index');
    $router->post('/report/{id}/comments', 'ItemReportCommentController@store');
    $router->post('/comment/{id}', 'ItemReportCommentController@storeComment');
    
    $router->get('/categories[/{id}]', 'CategoryController@index');
    $router->get('/categories/{id}/subs', 'CategoryController@subs');
});