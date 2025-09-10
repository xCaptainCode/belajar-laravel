<?php

namespace App\Http\Controllers;

use App\Model\User;

class HelloController extends Controller {

  public function index() {

    // $users = User::all();
    return view("hello", compact("users"));
    
  }
  
}
