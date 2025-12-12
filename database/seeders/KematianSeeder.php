<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KematianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $wargaIds = DB::table('warga')->pluck('warga_id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            DB::table('peristiwa_kematian')->insert([
                'warga_id'      => $faker->randomElement($wargaIds),
                'tgl_meninggal' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                'sebab'         => $faker->randomElement([
                    'Sakit keras',
                    'Kecelakaan lalu lintas',
                    'Faktor usia lanjut',
                    'Wabah penyakit',
                    'Kecelakaan kerja',
                    'Lainnya',
                ]),
                'lokasi'        => $faker->address,
                'no_surat'      => strtoupper(
                    $faker->bothify('SK-####/DS-??/' . $faker->year())
                ),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
