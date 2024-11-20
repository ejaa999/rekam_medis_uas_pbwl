<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratIjinPraktek extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function tenaga_kesehatan(){
        return $this->belongsTo(User::class,'tenaga_kesehatan_id');
    }
}
