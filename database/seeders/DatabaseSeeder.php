<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\ToDoList;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        user::create([
            'nama' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'nim' => '12345',
            'alamat' => 'karawang',

        ]);
        User::factory(5)->create();
        MataKuliah::create([
            'mata_kuliah' => 'Algoritma',
            'user_id' => 2
            
        ]);
        MataKuliah::create([
            'mata_kuliah' => 'Pemrograman Dasar',
            'user_id' => 3
        ]);
        // ToDoList::create([
        //     'nama_list' => 'Belajar Pemrograman',
        //     'user_id' => 2
        // ]);
        // ToDoList::create([
        //     'nama_list' => 'Belajar Algoritma',
        //     'user_id' => 3
        // ]);
    }
}
