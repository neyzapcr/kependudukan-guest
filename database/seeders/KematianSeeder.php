<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KematianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker    = Faker::create('id_ID');
        $wargaIds = DB::table('warga')->pluck('warga_id')->toArray();
        shuffle($wargaIds);

// hanya sebagian kecil meninggal
        $jumlah = intval(count($wargaIds) * 0.1);

        $wargaMeninggal = array_slice($wargaIds, 0, $jumlah);

        foreach ($wargaMeninggal as $id) {
            DB::table('peristiwa_kematian')->insert([
                'warga_id'      => $id,
                'tgl_meninggal' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                'sebab'         => fake()->randomElement([
                    'Sakit', 'Usia lanjut', 'Kecelakaan',
                ]),
                'lokasi'        => fake()->address,
                'no_surat'      => fake()->numerify('SK-####'),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }

    }
}
