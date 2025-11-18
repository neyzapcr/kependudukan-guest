<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateKeluargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $faker = Faker::create('id_ID');

        // Ambil data warga
        $wargas = DB::table('warga')->get()->toArray();

        // Acak data warga
        shuffle($wargas);

        // Buat 15 keluarga
        for ($i = 0; $i < 15; $i++) {
            // Ambil 3-5 warga random untuk 1 keluarga
            $keluargaMembers = array_slice($wargas, $i * 4, rand(3, 5));

            if (count($keluargaMembers) < 2) break;

            $kepalaKeluarga = $keluargaMembers[0];

            $kkId = DB::table('keluarga_kk')->insertGetId([
                'kk_nomor' => $faker->numerify('32##############'),
                'kepala_keluarga_warga_id' => $kepalaKeluarga->warga_id,
                'alamat' => $kepalaKeluarga->alamat,
                'rt' => $faker->numerify('00#'),
                'rw' => $faker->numerify('00#'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Input anggota
            foreach ($keluargaMembers as $index => $member) {
                DB::table('anggota_keluarga')->insert([
                    'kk_id' => $kkId,
                    'warga_id' => $member->warga_id,
                    'hubungan' => $index === 0 ? 'Kepala Keluarga' : $faker->randomElement(['Istri', 'Anak', 'Anak', 'Orang Tua']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Data keluarga berhasil dibuat!');
    }
}
