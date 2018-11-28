<?php

use Illuminate\Database\Seeder;
use App\Note;
use App\User;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();
        // call our class and run our seeds
        $this->call('dbSeeder');
        $this->command->info('Finished Seeding initial test Data.');

    }
}

class dbSeeder extends Seeder {
    public function run() {
        $this->command->info('Emptying tables...');
        DB::table('access_rights')->delete();
        DB::table('users')->delete();
        DB::table('notes')->delete();
        $this->command->info('Seeding User Tables...');

        $User1 = User::create(array(
            'name'              => 'admin',
            'email'             => 'admin@admin.com',
            'password'          => bcrypt('admin')
        ));

        $User2 = User::create(array(
            'name'              => 'kevin',
            'email'             => 'kevin@kevin.com',
            'password'          => bcrypt('kevin')
        ));

        $User3 = User::create(array(
            'name'              => 'afifah',
            'email'             => 'afifah@afifah.com',
            'password'          => bcrypt('afifah')
        ));

        $User3 = User::create(array(
            'name'              => 'swandika',
            'email'             => 'swandika@swandika.com',
            'password'          => bcrypt('swandika')
        ));

        $User4 = User::create(array(
            'name'              => 'tony',
            'email'             => 'tony@tony.com',
            'password'          => bcrypt('tony')
        ));

        $User5 = User::create(array(
            'name'              => 'hanandika',
            'email'             => 'hanandika@hanandika.com',
            'password'          => bcrypt('hanandika')
        ));

        $this->command->info('Seeding Note Tables...');
        $Note1 = Note::create(array(
            'user_id'           => $User1->id,
            'title'             => 'Admin Note',
            'content'           => 'Sample first note in the database by the admin',
            'date_created'      => Carbon::now(),
            'date_modified'     => Carbon::now()
        ));

        $Note2 = Note::create(array(
            'user_id'           => $User1->id,
            'title'             => 'Admin Note #2',
            'content'           => 'Second note in the database by the admin, Lorem Ipsum Sample Text',
            'date_created'      => Carbon::now(),
            'date_modified'     => Carbon::now()
        ));

        $Note3 = Note::create(array(
            'user_id'           => $User1->id,
            'title'             => 'THIRD Note',
            'content'           => '3rd note in the database by admin',
            'date_created'      => Carbon::now(),
            'date_modified'     => Carbon::now()
        ));

        $Note4 = Note::create(array(
            'user_id'           => $User2->id,
            'title'             => "Kevin's Note",
            'content'           => 'Hello, Aloha, Konbanwa, selamat pagi!',
            'date_created'      => Carbon::now(),
            'date_modified'     => Carbon::now()
        ));

        $Note5 = Note::create(array(
            'user_id'           => $User3->id,
            'title'             => "SAMPLE Note",
            'content'           => 'SAMPLE SAMPLE SAMPLE SAMPLE SAMPLE SAMPLE SAMPLE SAMPLE SAMPLE',
            'date_created'      => Carbon::now(),
            'date_modified'     => Carbon::now()
        ));

        $Note6 = Note::create(array(
            'user_id'           => $User4->id,
            'title'             => "TEST Note",
            'content'           => 'TESTING 1. 2. 3.',
            'date_created'      => Carbon::now(),
            'date_modified'     => Carbon::now()
        ));

        $this->command->info('Seeding Access Tables...');
        $User1->shared_notes()->attach($Note4->id);
        $User1->shared_notes()->attach($Note5->id);
        $User1->shared_notes()->attach($Note6->id);

        $User2->shared_notes()->attach($Note1->id);
        $User3->shared_notes()->attach($Note1->id);
        $User4->shared_notes()->attach($Note1->id);
        $User5->shared_notes()->attach($Note1->id);

    }
}