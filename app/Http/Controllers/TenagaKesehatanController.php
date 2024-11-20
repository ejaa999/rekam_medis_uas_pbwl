<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TenagaKesehatanController extends Controller
{
    public function index(){
        return view('tenaga_kesehatan_saya.index');
    }
}
