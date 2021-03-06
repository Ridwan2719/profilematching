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
        \App\Penilaian::create([
            'keterangan' => "Atlet Kumite",
            'bobot' => 1,
        ]);
        \App\Penilaian::create([
            'keterangan' => "Atlet Kata",
            'bobot' => 2,
        ]);
        \App\Penilaian::create([
            'keterangan' => "Atlet Beregu",
            'bobot' => 2,
        ]);
        \App\Jenisbobot::create([
            'keterangan' => "Bobot A",
        ]);
        \App\Jenisbobot::create([
            'keterangan' => "Bobot B",
        ]);
        \App\JenisKriteria::create([
            'keterangan' => "Core Factor",
            'nilai' => 60,
        ]);
        \App\JenisKriteria::create([
            'keterangan' => "Secondary Factor",
            'nilai' => 40,
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
            'gap_a' => -1,
            'gap_b' => -1,
            'nilai' => 4,
            'jenisbobot_id' => 1,
            'keterangan' => "Kopetensi individu kekurangan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 2,
            'gap_b' => 2,
            'nilai' => 3.5,
            'jenisbobot_id' => 1,
            'keterangan' => "Kopetensi individu kelebihan 2 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -2,
            'gap_b' => -2,
            'nilai' => 3,
            'jenisbobot_id' => 1,
            'keterangan' => "Kopetensi individu kekurangan 2 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 3,
            'gap_b' => 3,
            'nilai' => 2.5,
            'jenisbobot_id' => 1,
            'keterangan' => "Kopetensi individu kelebihan 3 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -3,
            'gap_b' => -3,
            'nilai' => 2,
            'jenisbobot_id' => 1,
            'keterangan' => "Kopetensi individu kekurangan 3 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 4,
            'gap_b' => 4,
            'nilai' => 1.5,
            'jenisbobot_id' => 1,
            'keterangan' => "Kopetensi individu kelebihan 4 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -4,
            'gap_b' => -4,
            'nilai' => 1,
            'jenisbobot_id' => 1,
            'keterangan' => "Kopetensi individu kekurangan 4 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 0,
            'gap_b' => 0,
            'nilai' => 5,
            'jenisbobot_id' => 2,
            'keterangan' => "Tidak ada selisih (Kopetensi sesuai yang dibutuhkan)",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 1,
            'gap_b' => 5,
            'nilai' => 4.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 2,
            'gap_b' => 0,
            'nilai' => 4.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 3,
            'gap_b' => 0,
            'nilai' => 4.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 4,
            'gap_b' => 0,
            'nilai' => 4.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 5,
            'gap_b' => 0,
            'nilai' => 4.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -1,
            'gap_b' => -5,
            'nilai' => 4,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -2,
            'gap_b' => 0,
            'nilai' => 4,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -3,
            'gap_b' => 0,
            'nilai' => 4,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -4,
            'gap_b' => 0,
            'nilai' => 4,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -5,
            'gap_b' => 0,
            'nilai' => 4,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 1 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 6,
            'gap_b' => 10,
            'nilai' => 3.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 2 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 7,
            'gap_b' => 0,
            'nilai' => 3.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 2 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 8,
            'gap_b' => 0,
            'nilai' => 3.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 2 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 9,
            'gap_b' => 0,
            'nilai' => 3.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 2 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 10,
            'gap_b' => 0,
            'nilai' => 3.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 2 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -6,
            'gap_b' => -10,
            'nilai' => 3,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 2 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -7,
            'gap_b' => 0,
            'nilai' => 3,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 2 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -8,
            'gap_b' => 0,
            'nilai' => 3,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 2 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -9,
            'gap_b' => 0,
            'nilai' => 3,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 2 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -10,
            'gap_b' => 0,
            'nilai' => 3,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 2 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 11,
            'gap_b' => 15,
            'nilai' => 2.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 3 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 12,
            'gap_b' => 0,
            'nilai' => 2.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 3 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 13,
            'gap_b' => 0,
            'nilai' => 2.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 3 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 14,
            'gap_b' => 0,
            'nilai' => 2.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 3 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => 15,
            'gap_b' => 0,
            'nilai' => 2.5,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kelebihan 3 tingkat/level",
        ]);
        \App\BobotAwal::create([
            'gap_a' => -11,
            'gap_b' => -15,
            'nilai' => 2,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 3 tingkat/level",
        ]);   
        \App\BobotAwal::create([
            'gap_a' => -12,
            'gap_b' => 0,
            'nilai' => 2,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 3 tingkat/level",
        ]);   
        \App\BobotAwal::create([
            'gap_a' => -13,
            'gap_b' => 0,
            'nilai' => 2,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 3 tingkat/level",
        ]);   
        \App\BobotAwal::create([
            'gap_a' => -14,
            'gap_b' => 0,
            'nilai' => 2,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 3 tingkat/level",
        ]);   
        \App\BobotAwal::create([
            'gap_a' => -15,
            'gap_b' => 0,
            'nilai' => 2,
            'jenisbobot_id' => 2,
            'keterangan' => "Kopetensi individu kekurangan 3 tingkat/level",
        ]);   
        \App\Kriteria::create([
            'penilaian_id' => 1,
            'jenisbobot_id' => 1,
            'nilai' => 3,
            'keterangan' => "Sambon",
        ]);
        \App\Kriteria::create([
            'penilaian_id' => 1,
            'jenisbobot_id' => 1,
            'nilai' => 2,
            'keterangan' => "Nihhon",
        ]);

        \App\Kriteria::create([
            'penilaian_id' => 1,
            'jenisbobot_id' => 2,
            'nilai' => 1,
            'keterangan' => "Ippon",
        ]);
        \App\Kriteria::create([
            'penilaian_id' => 2,
            'jenisbobot_id' => 1,
            'nilai' => 80,
            'keterangan' => "Kinerja Teknis",
        ]);
        \App\Kriteria::create([
            'penilaian_id' => 2,
            'jenisbobot_id' => 2,
            'nilai' => 70,
            'keterangan' => "Kinerja Atlet",
        ]);
        \App\Kriteria::create([
            'penilaian_id' => 3,
            'jenisbobot_id' => 1,
            'nilai' => 80,
            'keterangan' => "Kinerja Kata",
        ]);
        \App\Kriteria::create([
            'penilaian_id' => 3,
            'jenisbobot_id' => 1,
            'nilai' => 70,
            'keterangan' => "Kinerja Atlet",
        ]);
        \App\Kriteria::create([
            'penilaian_id' => 3,
            'jenisbobot_id' => 2,
            'nilai' => 80,
            'keterangan' => "Kinerja Bunkai",
        ]);
        \App\Atlet::create([
            'nama' => "User A",
            'umur' => 12,
            'kelas' => 2,
        ]);
        \App\Atlet::create([
            'nama' => "User B",
            'umur' => 12,
            'kelas' => 2,
        ]);
        \App\Atlet::create([
            'nama' => "User C",
            'umur' => 12,
            'kelas' => 2,
        ]);
        \App\Atlet::create([
            'nama' => "User D",
            'umur' => 12,
            'kelas' => 2,
        ]);
        \App\Periode::create([
            'keterangan' => "2020-06-20",
            'status' => "Aktif",
        ]);
        \App\DataAwal::create([
            'atlet_id' => 1,
            'periode_id' => 1,
            'kriteria_id' => 2,
            'penilaian_id' => 1,
            'nilai' => 3,
        ]);
        \App\DataAwal::create([
            'atlet_id' => 1,
            'periode_id' => 1,
            'kriteria_id' => 1,
            'penilaian_id' => 1,
            'nilai' => 2,
        ]);
        \App\DataAwal::create([
            'atlet_id' => 1,
            'periode_id' => 1,
            'kriteria_id' => 3,
            'penilaian_id' => 1,
            'nilai' => 1,
        ]);
        \App\DataAwal::create([
            'atlet_id' => 2,
            'periode_id' => 1,
            'kriteria_id' => 2,
            'penilaian_id' => 1,
            'nilai' => 2,
        ]);
        \App\DataAwal::create([
            'atlet_id' => 2,
            'periode_id' => 1,
            'kriteria_id' => 1,
            'penilaian_id' => 1,
            'nilai' => 3,
        ]);
        \App\DataAwal::create([
            'atlet_id' => 2,
            'periode_id' => 1,
            'kriteria_id' => 3,
            'penilaian_id' => 1,
            'nilai' => 1,
        ]);
    }
}
