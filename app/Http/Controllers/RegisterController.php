<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KtpPasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function store(Request $request){
        $validated_data = $request->validate([
            'username' => 'required|unique:users,username|max:32|regex:/^\S*$/',
            'nama' => 'required|max:64',
            'password' => 'required|min:6'
        ]);

        $validated_data['password'] = password_hash($validated_data['password'],PASSWORD_DEFAULT);

        $created_user = User::create($validated_data);
        $created_user->assignRole('pasien');
        KtpPasien::create(['pasien_id' => $created_user->id]);

        return redirect()->to('login')->with('success','Akun berhasil didaftarkan');
    }
}
