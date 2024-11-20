<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hubungan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FaskesHasTenagaKesehatan;

class HubunganController extends Controller
{
    
    public function pengajuan(){
        // ini halaman cari dokter di akun pasien
        $this->cek_roles('pasien');

        $tenaga_kesehatan_ada_hubungan = Hubungan::where('pasien_id',auth()->user()->id)->pluck('tenaga_kesehatan_id');
        $tenaga_kesehatan_tunggu_respon = Hubungan::where('pasien_id',auth()->user()->id)->where("status_hubungan",'0')->pluck('tenaga_kesehatan_id');
        $data['calon_tenaga_kesehatans'] = User::where('visibility',1)->whereNotIn('id',$tenaga_kesehatan_ada_hubungan)->where('tipe_tenaga_kesehatan','!=','0')->get();
        $data['calon_tenaga_kesehatans_tunggu_respon'] = User::where('visibility',1)->whereIn('id',$tenaga_kesehatan_tunggu_respon)->where('tipe_tenaga_kesehatan','!=','0')->get();
        return view('hubungan.pengajuan',$data);
    }

    public function permintaan(){
        // ini halaman permintaan menghubungkan di akun tenaga kesehatan
        $this->cek_roles('tenaga_kesehatan');

        $data['hubungan_calon_pasiens'] = Hubungan::where('tenaga_kesehatan_id',auth()->user()->id)->where('status_hubungan',0)->get();
        return view('hubungan.permintaan',$data);
    }

    public function get_tenaga_kesehatan($tenaga_kesehatan_id){
        return User::find($tenaga_kesehatan_id)->toJSON();
    }

    public function get_faskes_has_tenaga_kesehatan($tenaga_kesehatan_id){
        return FaskesHasTenagaKesehatan::with('faskes','tenaga_kesehatan')->where('tenaga_kesehatan_id',$tenaga_kesehatan_id)->get()->toJSON();
    }

    public function submit_ajukan($tenaga_kesehatan_id){
        $this->cek_roles('pasien');

        Hubungan::create([
            'tenaga_kesehatan_id' => $tenaga_kesehatan_id,
            'pasien_id' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success','Sukses mengajukan');
    }

    public function terima($hubungan_id){
        $this->cek_roles('tenaga_kesehatan');

        Hubungan::where('id',$hubungan_id)->update(['status_hubungan' => 1]);

        return redirect()->back()->with('success',"Berhasil menerima");
    }

    public function tolak($hubungan_id){
        $this->cek_roles('tenaga_kesehatan');

        Hubungan::where('id',$hubungan_id)->delete();

        return redirect()->back()->with('success',"Berhasil menolak");
    }

    public function pasien_saya(){
        $this->cek_roles('tenaga_kesehatan');

        $pasien_ids = Hubungan::where('tenaga_kesehatan_id',auth()->user()->id)->where('status_hubungan',1)->pluck('pasien_id');
        $data['pasiens_saya'] = User::whereIn('id',$pasien_ids)->get();
        return view('hubungan.pasien_saya',$data);
    }

    public function tenaga_kesehatan_saya(){
        $this->cek_roles('pasien');

        $tenaga_kesehatan_ids = Hubungan::where('pasien_id',auth()->user()->id)->where('status_hubungan',1)->pluck('tenaga_kesehatan_id');
        $data['tenaga_kesehatans_saya'] = User::whereIn('id',$tenaga_kesehatan_ids)->get();
        return view('hubungan.tenaga_kesehatan_saya',$data);
    }

    public function putuskan_hubungan($tipe,$pasien_or_tenaga_kesehatan_id){
        if($tipe == "dari_pasien"){

            $this->cek_roles('pasien');
            
            Hubungan::where('tenaga_kesehatan_id',$pasien_or_tenaga_kesehatan_id)->where('pasien_id',auth()->user()->id)->delete();
            
        }else{
            $this->cek_roles('tenaga_kesehatan');
            
            Hubungan::where('tenaga_kesehatan_id',auth()->user()->id)->where('pasien_id',$pasien_or_tenaga_kesehatan_id)->delete();
            
        }
            return redirect()->back()->with('success','Berhasil memutuskan hubungan');
    }
}
