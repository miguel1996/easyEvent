<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {    
        $this->call('GroupTableSeeder');
        $this->call('UserTableSeeder');
    }


}


class GroupTableSeeder extends Seeder {

    public function run()
    {
        DB::table('groups')->delete();
        DB::table('groups')->insert(['id'=>1,'name' => 'admin']);
        DB::table('groups')->insert(['id'=>2,'name' => 'member']);
        DB::table('groups')->insert(['id'=>3,'name' => 'event_manager']);
    }
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'tomas',//str_random(10),
            'email' => 'tomas@hotmail.com',//str_random(10).'@gmail.com',
            'password' => bcrypt('123456'),
            'date_of_birth' => Carbon::parse('07/11/1995'),
            'address' => 'rua da '.str_random(7),
            'phone_number' => random_int(100000000,999999999),
            'gender' => 'male',
            'group_id' => 1
        ]);
    }
}

class ElementTableSeeder extends Seeder {

    public function run()
    {
        DB::table('elements')->delete();
        DB::table('elements')->insert([
            'label' => 'idade',
            'type' => 'date'
        ]);
        DB::table('elements')->insert([
            'label' => 'calçado',
            'type' => 'number'
        ]);
        DB::table('elements')->insert([
            'label' => 'alergias',
            'type' => 'text'
        ]);
        // DB::table('users')->insert([
        //     'name' => 'tomas',//str_random(10),
        //     'email' => 'tomas@hotmail.com',//str_random(10).'@gmail.com',
        //     'password' => bcrypt('123456')
        // ]);
        // $this->call(UsersTableSeeder::class);
    }
}

class EventTableSeeder extends Seeder {

    public function run()
    {
        DB::table('events')->delete();
        // DB::table('events')->insert([
        //     'name' => 'tomas',//str_random(10),
        //     'email' => 'tomas@hotmail.com',//str_random(10).'@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'date_of_birth' => Carbon::parse('07/11/1995'),
        //     'address' => 'rua da '.str_random(7),
        //     'phone_number' => random_int(100000000,999999999),
        //     'gender' => 'male',
        //     'group_id' => 1
        // ]);
    }
}
