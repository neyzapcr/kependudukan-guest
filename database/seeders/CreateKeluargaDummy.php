<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateKeluargaDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil data warga
        $wargas = DB::table('warga')->get()->toArray();

        if (count($wargas) === 0) {
            $this->command->warn('Tidak ada data warga. Seeder keluarga dibatalkan.');
            return;
        }

        // Acak data warga
        shuffle($wargas);

        $totalWarga = count($wargas);

        // Tentukan jumlah keluarga (opsional)
        // Bisa tetap 15, tapi jangan lebih dari jumlah warga
        $jumlahKeluarga = min(100, $totalWarga);

        for ($i = 0; $i < $jumlahKeluarga; $i++) {

            if (count($wargas) === 0) break;

            // min 1 max 12, tapi jangan melebihi sisa warga
            $jumlahAnggota = rand(1, min(15, count($wargas)));

            // Ambil anggota keluarga dari list warga (biar tidak dobel KK)
            $keluargaMembers = array_splice($wargas, 0, $jumlahAnggota);

            // Kepala keluarga selalu anggota pertama
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

            foreach ($keluargaMembers as $index => $member) {

                // anggota pertama = kepala keluarga
                if ($index === 0) {
                    $hubungan = 'Kepala Keluarga';
                } else {
                    // random hubungan selain kepala keluarga
                    $hubungan = $faker->randomElement([
                        'Istri', 'Suami',
                        'Anak', 'Anak', 'Anak',
                        'Orang Tua', 'Lainnya'
                    ]);
                }

                DB::table('anggota_keluarga')->insert([
                    'kk_id' => $kkId,
                    'warga_id' => $member->warga_id,
                    'hubungan' => $hubungan,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Data keluarga berhasil dibuat (min 1 max 15 anggota per KK)!');
    }
}
