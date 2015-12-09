<?php

$app->get('/', function () use ($app) {
    return view('index');
});

// Messages
$app->get('message', 'MessageController@index');
$app->post('message', 'MessageController@store');
$app->get('message/{id}', 'MessageController@show');
$app->get('message/search/{phrase}', 'MessageController@search');

// Venues
$app->get('place', 'PlaceController@index');
$app->post('place', 'PlaceController@store');
$app->get('place/{id}', 'PlaceController@show');

// Events
$app->get('event', 'EventController@index');
$app->post('event', 'EventController@store');
$app->get('event/{id}', 'EventController@show');