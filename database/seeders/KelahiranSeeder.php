<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class KelahiranSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua warga_id buat relasi FK
        // Kalau PK di warga namanya "id", ganti jadi pluck('id')
        $wargaIds = DB::table('warga')->pluck('warga_id')->toArray();

        if (count($wargaIds) === 0) {
            $this->command->warn("Tabel warga kosong. Isi dulu warga sebelum seeding kelahiran.");
            return;
        }

        $now = Carbon::now();

        $rows = [];
        $count = 200; // mau berapa data

        for ($i = 0; $i < $count; $i++) {
            $bayiId = $faker->randomElement($wargaIds);

            // Biar realistic: ayah/ibu beda dari bayi
            $ayahId = $faker->randomElement($wargaIds);
            while ($ayahId == $bayiId) {
                $ayahId = $faker->randomElement($wargaIds);
            }

            $ibuId = $faker->randomElement($wargaIds);
            while ($ibuId == $bayiId || $ibuId == $ayahId) {
                $ibuId = $faker->randomElement($wargaIds);
            }

            $rows[] = [
                'warga_id'      => $bayiId,
                'tgl_lahir'     => $faker->dateTimeBetween('-30 years', 'now')->format('Y-m-d'),
                'tempat_lahir'  => $faker->city(),
                'ayah_warga_id' => $ayahId,
                'ibu_warga_id'  => $ibuId,
                'no_akta'       => $faker->boolean(90)
                        ? $faker->unique()->numerify('AKTA-######')
                        : null,
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        }

        DB::table('peristiwa_kelahiran')->insert($rows);
    }
}
