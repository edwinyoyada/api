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
    return $app->version();
});

/**
 * Routes for resource province
 */
$app->get('provinces', 'ProvincesController@all');
$app->get('province/{id}', 'ProvincesController@get');

/**
 * Routes for resource city
 */
$app->get('cities', 'CitiesController@all');
$app->get('city/{id}', 'CitiesController@get');
$app->get('city/{id}/{parent}' , 'CitiesController@getParent');
