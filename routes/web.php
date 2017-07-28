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

/* Welcome blade */
$app->get('/', function () use ($app) {
    return view('welcome');
});

/* Generate a randon key */
$app->get('/key', function() {
    return str_random(32);
});

/*Seller methods */
$app->post('/sellers', 'SellersController@store');
$app->get('/sellers', 'SellersController@get');
