<?php

use Illuminate\Database\Seeder;
// use RolesAndPermissionsSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(RolesAndPermissionsSeeder::class);
        // if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
        // Call the php artisan migrate:refresh
        $this->command->call('migrate:fresh');

        // $this->command->warn("Data cleared, starting from blank database.");
        // }
        \App\User::create([
            'name' => "Super Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make("admin"),
        ]);
        \App\Jenisbobot::create([
            'keterangan' => "Bobot A",
        ]);
        \App\Jenisbobot::create([
            'keterangan' => "Bobot B",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 0,
            'gap_b' => 0,
            'nilai' => 5,
            'jenisbobot_id' => 1,
            'keterangan' => "Tidak ada selisih (Kopetensi sesuai yang dibutuhkan)",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 1,
            'gap_b' => 1,
            'nilai' => 4.5,
            'jenisbobot_id' => 1,
            'keterangan' => "Kopetensi individu kelebihan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 0,
            'gap_b' => 0,
            'nilai' => 4.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 0,
            'gap_b' => 0,
            'nilai' => 5,
            'jenisbobot_id' => 2,
            'keterangan' => "Tidak ada selisih (Kopetensi sesuai yang dibutuhkan)",
        ]);
    }
}
