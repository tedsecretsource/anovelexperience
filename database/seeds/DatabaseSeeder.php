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
        $role = Role::create(['name' => 'administrator']);
        $ted->assignRole('administrator');
        $this->call(SubscriptionStatusTableSeeder::class);
        $this->call(SubscriptionTypeTableSeeder::class);
    }
}
