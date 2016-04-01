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


/*$app->get('/', function () use ($app) {
    return $app->version();
});*/

/**
 * Routes for resource province
 */
//$app->post('asd', 'ProvincesController@all')->middleware('auth');
$app->get('provinces', 'ProvincesController@all');
$app->get('province/{id}', 'ProvincesController@get');
$app->get('province/{id}/{relation}', 'ProvincesController@getRelationship');

/**
 * Routes for resource city
 */
$app->get('cities', 'CitiesController@all');
$app->get('city/{id}', 'CitiesController@get');
$app->get('city/{id}/{relation}', 'CitiesController@getRelationship');

$app->get('districts', 'DistrictsController@all');
$app->get('district/{id}', 'DistrictsController@get');
$app->get('district/{id}/{relation}', 'DistrictsController@getRelationship');

$app->get('villages', 'VillagesController@all');
$app->get('village/{id}', 'VillagesController@get');
$app->get('village/{id}/{relation}', 'VillagesController@getRelationship');