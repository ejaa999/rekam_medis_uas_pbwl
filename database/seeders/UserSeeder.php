<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\KtpPasien;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'username' => 'admin',
            'password' => '$2y$10$tCZBMwJ3jifT20k/n3EI2.F3BUSf4hpXVmI4uKFggpLfBo8qJ0Awi',
            'nama' => 'Admin Web',
            'no_hp' => '082129696162',
            'tipe_tenaga_kesehatan' => 0,
        ]);

        $dokter = User::create([
            'username' => 'dokter',
            'password' => '$2y$10$tCZBMwJ3jifT20k/n3EI2.F3BUSf4hpXVmI4uKFggpLfBo8qJ0Awi',
            'nama' => 'Dr. Abidzar',
            'no_hp' => '08123456789',
            'tipe_tenaga_kesehatan' => 1,
        ]);

        $pengobat_tradisional = User::create([
            'username' => 'pengobat_tradisional',
            'password' => '$2y$10$tCZBMwJ3jifT20k/n3EI2.F3BUSf4hpXVmI4uKFggpLfBo8qJ0Awi',
            'nama' => 'Bapak Gatot',
            'no_hp' => '08123456789',
            'tipe_tenaga_kesehatan' => 2,
        ]);

        $pasien = User::create([
            'username' => 'pasien',
            'password' => '$2y$10$tCZBMwJ3jifT20k/n3EI2.F3BUSf4hpXVmI4uKFggpLfBo8qJ0Awi',
            'nama' => 'Pasien',
            'no_hp' => '08123456789',
            'jenis_kelamin' => 1,
            'tanggal_lahir' => '2003-05-02',
            'tipe_tenaga_kesehatan' => 0,
        ]);



        $admin->assignRole('admin');
        $dokter->assignRole('tenaga_kesehatan');
        $pengobat_tradisional->assignRole('tenaga_kesehatan');
        $pasien->assignRole('pasien');

        // ktp pasien
        KtpPasien::create([
            'pasien_id' => $pasien->id
        ]);
    }
}
