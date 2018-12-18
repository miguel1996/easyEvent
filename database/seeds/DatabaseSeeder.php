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
        $this->call('ElementTableSeeder');
        $this->call('EventTableSeeder');
        $this->call('EventElementsTableSeeder');
        $this->call('SubscriptionTableSeeder');
        // $this->call(UsersTableSeeder::class);
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
        DB::table('events')->insert([
            'title' => 'Atividade de Padel',//str_random(10),
            'description' => 'atividade a decorrer no centro de padel do funchal em conjunção com o clube de padel da madeira',//str_random(10).'@gmail.com',
            'image_path' => '1543938927-evento1.PNG',//bcrypt('123456'),
            'event_date' => Carbon::parse('03/01/2019 16:00'),
            'opening_subscription_date' => Carbon::parse('01/01/2019 16:00'),
            'closing_subscription_date' => Carbon::parse('02/01/2019 16:00'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => '1'
        ]);
    }
}

class EventElementsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('events_elements')->delete();
        DB::table('events_elements')->insert([
            'event_id' => 1,//str_random(10),
            'element_id' => 2,//str_random(10).'@gmail.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('events_elements')->insert([
            'event_id' => 1,//str_random(10),
            'element_id' => 3,//str_random(10).'@gmail.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

class SubscriptionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('subscriptions')->delete();
        DB::table('subscriptions')->insert([
            'user_id' => 1,//str_random(10),
            'event_id' => 1,//str_random(10).'@gmail.com',
            'data' => serialize(array("2"=>"46", "3"=>"alergias ao camarao")),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
