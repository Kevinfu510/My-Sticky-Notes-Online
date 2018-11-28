<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(create_users_table::class);
        $this->call(create_notes_table::class);
        $this->call(create_access_rights_table::class);
        // $this->call(UsersTableSeeder::class);
      // tambahkan line ini
    }
}

class create_users_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::create([
        'id' => str_random(20),
        'username' =>str_random(20),
        'email' => str_random(20).'@gmail.com',
        'password' =>bcrypt('secret')
      ]);
        // $this->call(UsersTableSeeder::class);
    }
}


class create_notes_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::create([
    'id' => str_random(20),
    'user_id' => str_random(20),
    'title' => str_random(20),
    'content' => str_random(100),
    'date_create' => date("d MMM yyyy HH:mm:ss"),
    'date_modified' => date("d MMM yyyy HH:mm:ss")
]);
    }
        //
    }

class create_access_rights_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::create([
            'id' => str_random(20),
            'user_id' => str_random(20),
            'note_id' => str_random(20)

        ]);
      }
        //
}
