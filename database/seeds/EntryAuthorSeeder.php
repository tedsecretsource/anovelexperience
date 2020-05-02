<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class EntryAuthorTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\EntryAuthor::class, 28)->create();
        // $author = App\EntryAuthor::create([
        //     'name'     => 'Susan',
        //     'font'    => 'serif-one',
        // ]);
    }
}
