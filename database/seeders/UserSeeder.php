<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@sch.id',
            'password' => bcrypt('almadanioke')
        ]);

        $admin->assignRole('admin');


        $user = User::create([
            'name' => 'user',
            'nisn' => 123,
            'email' => 'user@sch.id',
            'password' => bcrypt('almadanioke')
        ]);

        $user->assignRole('user');

        $kepsek = User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepsek@sch.id',
            'password' => bcrypt('almadanioke')
        ]);

        $kepsek->assignRole('kepsek');
    }
}