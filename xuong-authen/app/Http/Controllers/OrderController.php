<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index() {
        if(Auth::user()->isAdmin()) {
            return view('admin.orders');
        }
        else if (Auth::user()->isEmployee()) {
            return  view('employee.orders');
        }
    }
}
