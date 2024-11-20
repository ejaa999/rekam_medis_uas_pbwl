<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hubungan;
use App\Models\KtpPasien;
use App\Models\RekamMedis;
use Faker\Factory as Faker;
use App\Models\AsuransiPasien;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $admin = User::create([
            'username' => 'admin',
            'password' => '$2y$10$tCZBMwJ3jifT20k/n3EI2.F3BUSf4hpXVmI4uKFggpLfBo8qJ0Awi',
            'nama' => 'Admin Web',
            'no_hp' => '08123456789',
            'tipe_tenaga_kesehatan' => 0,
        ]);
        $admin->assignRole('admin');


        // dokter
        for($i = 0 ; $i < 5 ; $i++){
            $dokter = User::create([
                'username' => $faker->username,
                'password' => '$2y$10$tCZBMwJ3jifT20k/n3EI2.F3BUSf4hpXVmI4uKFggpLfBo8qJ0Awi',
                'nama' => $faker->name,
                'no_hp' => '08123456789',
                'tipe_tenaga_kesehatan' => 1,
            ]);

            $dokter->assignRole('tenaga_kesehatan');
        }

        // pengobat_tradisional
        for($i = 0 ; $i < 5 ; $i++){
            $pengobat_tradisional = User::create([
                'username' => $faker->username,
                'password' => '$2y$10$tCZBMwJ3jifT20k/n3EI2.F3BUSf4hpXVmI4uKFggpLfBo8qJ0Awi',
                'nama' => $faker->name,
                'no_hp' => '08123456789',
                'tipe_tenaga_kesehatan' => 2,
            ]);

            $pengobat_tradisional->assignRole('tenaga_kesehatan');
        }

        // pasien
        for($i = 0 ; $i < 150 ; $i++){
            $nama = $faker->name;
            $tanggal_lahir = Carbon::today()->subDays(rand(7000, 20000));
            $jenis_kelamin = rand(1,2);

            $pasien = User::create([
                'username' => $faker->username,
                'password' => '$2y$10$tCZBMwJ3jifT20k/n3EI2.F3BUSf4hpXVmI4uKFggpLfBo8qJ0Awi',
                'nama' => $nama,
                'no_hp' => '08123456789',
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'tipe_tenaga_kesehatan' => 0,
            ]);

            $pasien->assignRole('pasien');

            // ktp
            KtpPasien::create([
                'pasien_id' => $pasien->id,
                'nik' => $faker->nik,
                'nama' => $nama,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'agama' => rand(1,6),
                'status_perkawinan' => rand(1,4),
                'golongan_darah' => rand(0,4),
                'alamat' => $faker->streetAddress,
                'pekerjaan' => 'swasta',
            ]);

            // asuransi
            $arr_penyedia = ["Prudential","CAR Insurance","CIGNA","MANULIFE","ALLIANZ","AXA"];
            AsuransiPasien::create([
                'pasien_id' => $pasien->id,
                'nomor_polis' => rand(100000000000,999999999999),
                'penyedia' => $arr_penyedia[rand(0,count($arr_penyedia)-1)],
                'no_telepon' => '021392932',
                'email' => 'insurance@ins.com',
            ]);


        }

        // arr rekam medis
        $arr_rekam_medis_personal = [
            ['Sakit kepala, sesak nafas','Tekanan darah tinggi','Obat anti darah tinggi'],
            ['Pelemakan hati, sesak nafas, nyeri dada','Kolestrol Tinggi','<ul><li>Obat statis</li><li>Pengobatan kolestrol</li></ul>']
        ];
        $arr_rekam_medis_dokter = [
            ['Pusing, nyeri dada, detak jantung tidak teratur, mual, nyeri perut atas (ulu hati)','serangan jantung','bedah jantung'],
            ['Batuk, sesak nafas, nafas berbunyi, kesulitan bernapas','Asma', '<ul><li>Anti inflamasi</li><li>Bronkodilator</li><li>Terapi oksigen</li></ul>']
        ];
        $arr_rekam_medis_dukun = [
            ['Urat tegang, peradangan otot','Tekanan darah rendah','Pijat refleksi di titik syaraf kaki'],
            ['Kadar gula darah tinggi','Diabetes','Pengobatan Akupuntur']
        ];

        // hubungan
        $pasiens = User::where('id','!=',1)->where('tipe_tenaga_kesehatan',0)->get();
        foreach($pasiens as $pasien){
            // rekam medis personal
            $rekam_medis = $arr_rekam_medis_personal[rand(0,1)];
            RekamMedis::create([
                'pasien_id' => $pasien->id,
                'tanggal' => Carbon::today()->subDays(rand(1, 10)),
                'tipe_rekam_medis' => 0,
                'anamnesa' => $rekam_medis[0],
                'diagnosis' => $rekam_medis[1],
                'terapi' => $rekam_medis[2],
            ]);
            // hubungan dgn dokter
            $exc = [];
            $i = 1;
            while(TRUE){
                $rand_id = rand(2,6);
                if( ! in_array($rand_id,$exc) ){
                    Hubungan::create([
                        'tenaga_kesehatan_id' => $rand_id,
                        'pasien_id' => $pasien->id,
                        'status_hubungan' => 1
                    ]);
                    array_push($exc,$rand_id);
                    // rekam medis dokter
                    $rekam_medis = $arr_rekam_medis_dokter[rand(0,1)];
                    RekamMedis::create([
                        'pasien_id' => $pasien->id,
                        'tenaga_kesehatan_id' => $rand_id,
                        'tanggal' => Carbon::today()->subDays(rand(1, 10)),
                        'tipe_rekam_medis' => 1,
                        'anamnesa' => $rekam_medis[0],
                        'diagnosis' => $rekam_medis[1],
                        'terapi' => $rekam_medis[2],
                    ]);
                    $i++;
                    if($i > 3){
                        break;
                    }
                }
            }
            // hubungan dgn pengobat trad
            $exc = [];
            $i = 1;
            while(TRUE){
                $rand_id = rand(7,11);
                if( ! in_array($rand_id,$exc) ){
                    Hubungan::create([
                        'tenaga_kesehatan_id' => rand(7,11),
                        'pasien_id' => $pasien->id,
                        'status_hubungan' => 1
                    ]);
                    array_push($exc, $rand_id);
                    $rekam_medis = $arr_rekam_medis_dukun[rand(0,1)];
                    RekamMedis::create([
                        'pasien_id' => $pasien->id,
                        'tenaga_kesehatan_id' => $rand_id,
                        'tanggal' => Carbon::today()->subDays(rand(1, 10)),
                        'tipe_rekam_medis' => 1,
                        'anamnesa' => $rekam_medis[0],
                        'diagnosis' => $rekam_medis[1],
                        'terapi' => $rekam_medis[2],
                    ]);
                    $i++;
                    if($i > 3){
                        break;
                    }
                }
            }
            // rekam medis dukun
        }

    }
}
