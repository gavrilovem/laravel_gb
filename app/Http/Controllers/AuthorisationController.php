<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorisationController extends Controller
{
    public function index() {
        return view('authorization/index');
    }
}
