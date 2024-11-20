<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function change_password(Request $request, User $user){
        $request->validate([
            'password_lama'=>'required|min:6|max:100',
            'password_baru'=>'required|min:6|max:100',
            'konfirmasi_password_baru'=>'required|same:password_baru',
        ]);
        
        $current_user=auth()->user();
        if(Hash::check($request->input('password_lama'),$current_user->password)){
            User::find($current_user->id)->update(['password' => bcrypt($request->password_baru)]);
            return redirect()->back()->with('success','Berhasil Ganti Password.');
        }else{
            return redirect()->back()->with('danger','Password Lama Tidak Cocok.');
        };
    }
}
