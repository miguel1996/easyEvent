<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserTableSeeder');
    }


}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'mlfranco',
            'email' => '2061010@student.uma.pt',
            'password' => bcrypt('qwe123')
        ]);
        // DB::table('users')->insert([
        //     'name' => 'tomas',//str_random(10),
        //     'email' => 'tomas@hotmail.com',//str_random(10).'@gmail.com',
        //     'password' => bcrypt('123456')
        // ]);
        // $this->call(UsersTableSeeder::class);
    }
}

// class UserTableSeeder extends Seeder {

//     public function run()
//     {
//         DB::table('users')->delete();
//         DB::table('users')->insert([
//             'name' => 'tomas',//str_random(10),
//             'email' => 'tomas@hotmail.com',//str_random(10).'@gmail.com',
//             'password' => bcrypt('123456')
//         ]);
//     }
// }