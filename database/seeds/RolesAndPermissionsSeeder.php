<?php

use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
            // Call the php artisan migrate:refresh
            $this->command->call('migrate:refresh');

            $this->command->warn("Data cleared, starting from blank database.");
        }

        \App\User::create([
            'name' => "Super Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make("admin"),
        ]);
        
    }
}