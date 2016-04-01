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


$app->get('/', function () use ($app) {
    return 'API nya Terhubung.';
});

/**
 * Routes for resource province
 */
//$app->post('asd', 'ProvincesController@all')->middleware('auth');
$app->get('provinces', ['middleware' => 'cors', 'uses' => 'ProvincesController@all']);
$app->get('province/{id}', ['middleware' => 'cors', 'uses' => 'ProvincesController@get']);
$app->get('province/{id}/{relation}', ['middleware' => 'cors', 'uses' => 'ProvincesController@getRelationship']);

/**
 * Routes for resource city
 */
$app->get('cities', ['middleware' => 'cors', 'uses' => 'CitiesController@all']);
$app->get('city/{id}', ['middleware' => 'cors', 'uses' => 'CitiesController@get']);
$app->get('city/{id}/{relation}', ['middleware' => 'cors', 'uses' => 'CitiesController@getRelationship']);

$app->get('districts', ['middleware' => 'cors', 'uses' => 'DistrictsController@all']);
$app->get('district/{id}', ['middleware' => 'cors', 'uses' => 'DistrictsController@get']);
$app->get('district/{id}/{relation}', ['middleware' => 'cors', 'uses' => 'DistrictsController@getRelationship']);

$app->get('villages', ['middleware' => 'cors', 'uses' => 'VillagesController@all']);
$app->get('village/{id}', ['middleware' => 'cors', 'uses' => 'VillagesController@get']);
$app->get('village/{id}/{relation}', ['middleware' => 'cors', 'uses' => 'VillagesController@getRelationship']);