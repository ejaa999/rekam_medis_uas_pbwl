<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Faskes;
use App\Models\KtpPasien;
use Illuminate\Http\Request;
use App\Models\SuratIjinPraktek;
use App\Http\Controllers\Controller;
use App\Models\FaskesHasTenagaKesehatan;

class ProfilController extends Controller
{
    public function index(){
        if(auth()->user()->hasRole('tenaga_kesehatan')){
            if(auth()->user()->tipe_tenaga_kesehatan == 1){
                $data['faskeses'] = Faskes::where('visibility',1)->where('tipe_faskes',1)->get();
            }else if(auth()->user()->tipe_tenaga_kesehatan == 2){
                $data['faskeses'] = Faskes::where('visibility',1)->where('tipe_faskes',2)->get();            
            }

            $data['faskes_has_tenaga_kesehatans'] = FaskesHasTenagaKesehatan::where('tenaga_kesehatan_id',auth()->user()->id)->get();
            $data['surat_ijin_prakteks'] = SuratIjinPraktek::where('tenaga_kesehatan_id',auth()->user()->id)->get();

            return view("profil.index",$data);
        }else{   
            return view("profil.index");
        }
    }

    public function reset_foto_profil(){
        User::where('id',auth()->user()->id)->update(['foto_profil' => 'assets/img/avatars/user.png']);

        return redirect()->back();
    }

    public function update_foto_profil(Request $request){
        $request->validate([
            'foto_profil' => 'file|image'
        ]);

        $validated_data['foto_profil'] = $request->file('foto_profil')->store('profil');

        User::where('id',auth()->user()->id)->update($validated_data);

        return redirect()->back();
    }

    public function update_profil(Request $request){
        $rules = [
            'nama' => 'required|max:64',
            'no_hp' => 'required|numeric',
            'jenis_kelamin' => 'nullable|numeric',
            'tanggal_lahir' => 'nullable|date'
        ];
        
        if($request->username != auth()->user()->username){
            $rules['username'] = 'required|unique:users,username|max:64|regex:/^\S*$/';
        }
       
        $validated_data = $request->validate($rules);
 
        User::where('id',auth()->user()->id)->update($validated_data);

        return redirect()->back()->with('success','Berhasil diubah');
    }
}
