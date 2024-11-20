<?php

namespace App\Models;

use App\Models\RekamMedis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LampiranRekamMedis extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function rekam_medis(){
        return $this->belongsTo(RekamMedis::class);
    }
}
