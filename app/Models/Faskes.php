<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FaskesHasTenagaKesehatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faskes extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function faskes_has_tenaga_kesehatan_list(){
        return $this->hasMany(FaskesHasTenagaKesehatan::class,'tenaga_kesehatan_id');
    }
}
