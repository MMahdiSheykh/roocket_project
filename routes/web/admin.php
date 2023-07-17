<?php

Route::get('/', function() {
    return view('admin.master');
});

Route::get('hi', function($value = 'hi') {
    return $value;
});