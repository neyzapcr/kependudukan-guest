<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateWargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Faker bahasa Indonesia

        for ($i = 0; $i < 100; $i++) { // Generate 50 data dummy
            DB::table('warga')->insert([
                'no_ktp' => $faker->numerify('32############'), // 16 digit
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan' => $faker->randomElement([
                    'Wiraswasta', 'PNS', 'Karyawan Swasta', 'Petani', 'Nelayan',
                    'Guru', 'Dokter', 'Perawat', 'Pedagang', 'Buruh', 'Mahasiswa'
                ]),
                'telp' => $faker->numerify('08##########'),
                'email' => $faker->unique()->safeEmail,
                'alamat' => $faker->address,
                'created_at' => now(),
            ]);
        }
    }
}

