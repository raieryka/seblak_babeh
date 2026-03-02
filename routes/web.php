<?php

use Illuminate\Support\Facades\Route;
use App\Models\Menu;
use App\Models\Topping;

Route::get('/', function () {
    $menu = Menu::all();
    $topping = Topping::all();
    return view('home', compact('menu','topping'));
});