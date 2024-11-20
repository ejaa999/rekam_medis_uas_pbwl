<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        if(auth()->user()->hasRole('admin')){
            return view('dashboard.admin_dashboard');
        }
        if(auth()->user()->hasRole('tenaga_kesehatan')){
            return view('dashboard.tenaga_kesehatan_dashboard');
        }
        if(auth()->user()->hasRole('pasien')){
            return view('dashboard.pasien_dashboard');
        }
    }
}
