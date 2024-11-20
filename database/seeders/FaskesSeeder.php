<?php

namespace Database\Seeders;

use App\Models\Faskes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaskesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faskes::create([
            'nama' => "Rumah Sakit Bhayangkara",
            'tipe_faskes' => 1,
            'alamat' => 'Jl. Kesehatan No. 1',
            'provinsi' => 'Jawa Timur',
            'kota' => 'Kediri'
        ]);

        Faskes::create([
            'nama' => "Klinik Semua Sehat",
            'tipe_faskes' => 1,
            'alamat' => 'Jl. Kesehatan No. 34',
            'provinsi' => 'Jawa Timur',
            'kota' => 'Kediri'
        ]);

        Faskes::create([
            'nama' => "Rumah Pijat Ora Pegel",
            'tipe_faskes' => 2,
            'alamat' => 'Jl. Melon No. 1',
            'provinsi' => 'Jawa Timur',
            'kota' => 'Kediri'
        ]);

        Faskes::create([
            'nama' => "Klinik Mbah Surono",
            'tipe_faskes' => 2,
            'alamat' => 'Jl. Anggur No. 1',
            'provinsi' => 'Jawa Timur',
            'kota' => 'Kediri'
        ]);
    }
}
