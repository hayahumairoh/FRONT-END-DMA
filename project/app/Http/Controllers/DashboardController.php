<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
    return view('layout.layout');
    }

    public function menu(){
    return view('mainmenu');
    }
}
