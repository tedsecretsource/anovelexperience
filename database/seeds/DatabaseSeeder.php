<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $ted = App\User::create([
            'name'     => 'Ted Stresen-Reuter',
            'email'    => 'tedmasterweb@gmail.com',
            'password' => Hash::make(rand(1323214, 908098008))
        ]);
        $julien = App\User::create([
            'name'     => 'Julien Leleviere',
            'email'    => 'julien.leleviere@gmail.com',
            'password' => Hash::make(rand(1323214, 908098008))
        ]);
        $drac = App\User::create([
            'name'     => 'Count Dracula',
            'email'    => 'bloodbank@dracula.email',
            'password' => Hash::make(rand(1323214, 908098008))
        ]);
        $role = Role::create(['name' => 'administrator']);
        $ted->assignRole('administrator');
        $julien->assignRole('administrator');
        $this->call(SubscriptionStatusTableSeeder::class);
        $this->call(SubscriptionTypeTableSeeder::class);
        $this->call(EntryAuthorTableSeeder::class);
        $this->call(NovelTableSeeder::class);
        $this->call(SubscriptionTableSeeder::class);
        // $this->call(EntryTableSeeder::class);
    }
}
