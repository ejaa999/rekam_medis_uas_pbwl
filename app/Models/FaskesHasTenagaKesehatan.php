<?php

namespace App\Models;

use App\Models\User;
use App\Models\Faskes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FaskesHasTenagaKesehatan extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function faskes(){
        return $this->belongsTo(Faskes::class);
    }

    public function tenaga_kesehatan(){
        return $this->belongsTo(User::class,'tenaga_kesehatan_id'); //relation ke user
    }
}
