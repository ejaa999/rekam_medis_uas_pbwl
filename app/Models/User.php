<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Hubungan;
use App\Models\KtpPasien;
use App\Models\RekamMedis;
use App\Models\AsuransiPasien;
use App\Models\SuratIjinPraktek;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\FaskesHasTenagaKesehatan;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles ,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function faskes_has_tenaga_kesehatan_list(){
        return $this->hasMany(FaskesHasTenagaKesehatan::class,'tenaga_kesehatan_id');
    }

    public function hubungan_tenaga_kesehatan_list(){
        return $this->hasMany(Hubungan::class,'tenaga_kesehatan_id');
    }

    public function hubungan_pasien_list(){
        return $this->hasMany(Hubungan::class,'pasien_id');
    }

    public function rekam_medis_tenaga_kesehatan_list(){
        return $this->hasMany(RekamMedis::class,'tenaga_kesehatan_id');
    }

    public function rekam_medis_pasien_list(){
        return $this->hasMany(RekamMedis::class,'pasien_id');
    }

    public function surat_ijin_praktek_list(){
        return $this->hasMany(SuratIjinPraktek::class,'tenaga_kesehatan_id');
    }

    public function ktp_pasien_single_list(){
        return $this->hasOne(KtpPasien::class,'pasien_id');
    }

    public function asuransi_pasien_list(){
        return $this->hasMany(AsuransiPasien::class,'pasien_id');
    }
}
