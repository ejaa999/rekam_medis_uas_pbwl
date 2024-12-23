<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KtpPasien extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function pasien(){
        return $this->belongsTo(User::class,'pasien_id');
    }
}
