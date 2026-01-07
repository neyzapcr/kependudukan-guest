<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelahiranSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $wargaIds = DB::table('warga')->pluck('warga_id')->toArray();
        shuffle($wargaIds);

        foreach ($wargaIds as $bayiId) {

            // tidak semua warga punya data kelahiran
            if (!$faker->boolean(60)) {
                continue;
            }

            // ayah & ibu harus beda dari bayi
            $ortuIds = array_diff($wargaIds, [$bayiId]);
            if (count($ortuIds) < 2) {
                continue;
            }

            $ayahId = $faker->randomElement($ortuIds);
            $ibuId  = $faker->randomElement(array_diff($ortuIds, [$ayahId]));

            DB::table('peristiwa_kelahiran')->insert([
                'warga_id'      => $bayiId,
                'tgl_lahir'     => $faker->dateTimeBetween('-30 years', 'now')->format('Y-m-d'),
                'tempat_lahir'  => $faker->city(),
                'ayah_warga_id' => $ayahId,
                'ibu_warga_id'  => $ibuId,
                'no_akta'       => $faker->unique()->numerify('AKTA-######'),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
