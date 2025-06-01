<?php

namespace Database\Seeders;
use App\Models\user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class untukakun extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

         public function run()
    {
        user::create([
            'username' => 'instruktur',
            'role' => 'instruktur',
            'id_role' => '1',
            //gimana bikin hashing password di laravel
            'password' => bcrypt('instruktur'),
        ]);
         user::create([
            'username' => 'siswa',
            'role' => 'siswa',
            'id_role' => '2',
            //gimana bikin hashing password di laravel
            'password' => bcrypt('siswa'),
        ]);
    }
    }

