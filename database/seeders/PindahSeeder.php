<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PindahSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // ambil semua warga_id yang valid dari tabel warga
        $wargaHidup = DB::table('warga')
            ->whereNotIn('warga_id', function ($q) {
                $q->select('warga_id')->from('peristiwa_kematian');
            })
            ->pluck('warga_id')
            ->toArray();

        shuffle($wargaHidup);

        $jumlah = intval(count($wargaHidup) * 0.2);

        $wargaPindah = array_slice($wargaHidup, 0, $jumlah);

        foreach ($wargaPindah as $id) {
            DB::table('peristiwa_pindah')->insert([
                'warga_id'      => $id,
                'tgl_pindah'    => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                'alamat_tujuan' => fake()->address,
                'alasan'        => fake()->randomElement([
                    'Ikut orang tua', 'Pekerjaan', 'Menikah',
                ]),
                'no_surat'      => fake()->numerify('SP-####'),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }

    }
}
