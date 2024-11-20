<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function cek_roles($roles){
        // cara pakai bisa dengan tanda |, contoh : 'guru|admin'
        if( ! auth()->user()->hasAnyRole($roles)){
            throw ValidationException::withMessages(['not_allowed' => 'not_allowed']);
        }
    }
}
