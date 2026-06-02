<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::fallback(function () {
    return '<p>Ops. Ocorreu um erro. Essa página não existe.</p>';
});

