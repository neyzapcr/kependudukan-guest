<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PindahSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // ambil semua warga_id yang valid dari tabel warga
        $wargaIds = DB::table('warga')->pluck('warga_id')->toArray();

        if (empty($wargaIds)) {
            dd('Tabel warga kosong! Jalankan WargaSeeder dulu.');
        }

        $alasanList = [
            'Pindah kerja',
            'Pindah rumah',
            'Pendidikan',
            'Menikah',
            'Ikut orang tua',
            'Mutasi tugas',
            'Lainnya',
        ];

        for ($i = 0; $i < 100; $i++) {
            DB::table('peristiwa_pindah')->insert([
                // pindah_id tidak diisi karena AUTO_INCREMENT

                'warga_id'      => $faker->randomElement($wargaIds),
                'tgl_pindah'    => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                'alamat_tujuan' => $faker->address,
                'alasan'        => $faker->randomElement($alasanList),
                'no_surat'      => strtoupper(
                    $faker->bothify('SP-####/DS-??/' . $faker->year())
                ),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
