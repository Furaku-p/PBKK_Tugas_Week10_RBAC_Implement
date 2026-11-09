<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use Illuminate\Database\Seeder;

class AcademicDataSeeder extends Seeder
{
    public function run(): void
    {
        $departemen = ['IF', 'SI', 'EL', 'BD'];

        Mahasiswa::firstOrCreate(
            ['nrp' => '5025241164'],
            [
                'nama' => 'Alfianz Risqia Ilahi Loven Kary',
                'email' => '5025241164@student.its.ac.id',
                'departemen_id' => 'IF',
                'is_active' => true,
            ]
        );

        foreach (range(1, 39) as $index) {
            Mahasiswa::firstOrCreate(
                ['nrp' => fake()->unique()->numerify('502524####')],
                [
                    'nama' => fake()->name(),
                    'email' => fake()->unique()->safeEmail(),
                    'departemen_id' => fake()->randomElement($departemen),
                    'is_active' => fake()->boolean(85),
                ]
            );
        }

        foreach (range(1, 12) as $index) {
            Dosen::firstOrCreate(
                ['nip' => fake()->unique()->numerify('198#########')],
                ['nama' => fake()->name(), 'email' => fake()->unique()->companyEmail()]
            );
        }

        foreach (range(1, 24) as $index) {
            Tugas::firstOrCreate(
                ['judul' => 'Tugas ' . fake()->unique()->words(3, true)],
                [
                    'departemen_id' => fake()->randomElement($departemen),
                    'deadline' => fake()->dateTimeBetween('-10 days', '+30 days')->format('Y-m-d'),
                    'is_active' => fake()->boolean(75),
                ]
            );
        }
    }
}
