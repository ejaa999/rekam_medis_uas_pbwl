<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\LampiranRekamMedis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekamMedis extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function scopeFilter($query,$filters){
        foreach($filters as $key => $value){
            if(in_array($key,['tipe_tenaga_kesehatan'])){
                if($key == "tipe_tenaga_kesehatan" && $value == "all"){ continue; }

                $tenaga_kesehatan_modern_ids = User::where('visibility',1)->where('tipe_tenaga_kesehatan',1)->pluck('id');
                $tenaga_kesehatan_tradisional_ids = User::where('visibility',1)->where('tipe_tenaga_kesehatan',2)->pluck('id');

                if($value == 1){
                    $query = $query->whereIn("tenaga_kesehatan_id",$tenaga_kesehatan_modern_ids);
                }else if($value == 2){
                    $query = $query->whereIn("tenaga_kesehatan_id",$tenaga_kesehatan_tradisional_ids);
                }
            }else if($key == "awal_tanggal"){
                $query = $query -> where('tanggal','>=',Carbon::parse($value)->format('Y-m-d H:i:s'));
            }else if($key == "akhir_tanggal"){
                $query = $query -> where('tanggal','<=',Carbon::parse($value)->addDays(1)->format('Y-m-d H:i:s'));
            }
        }

        return $query;
    }

    public function pasien(){
        return $this->belongsTo(User::class,'pasien_id');
    }

    public function tenaga_kesehatan(){
        return $this->belongsTo(User::class,'tenaga_kesehatan_id');
    }

    public function attachment_rekam_medis_list(){
        return $this->belongsTo(LampiranRekamMedis::class);
    }
}
