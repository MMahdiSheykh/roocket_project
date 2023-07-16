<?php

Route::get('/', function() {
    return view('welcome');
});

Route::get('hi', function($value = 'hi') {
    return $value;
});