<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chemical_stamps')->insert([
            [
                'id' => 1,
                'code' => 'GHS01',
                'path' => 'assets/images/shared/stamps/01.png',
                'created_at' => '2025-06-21 00:00:00',
                'updated_at' => '2025-06-21 00:00:00',
            ],
            [
                'id' => 2,
                'code' => 'GHS02',
                'path' => 'assets/images/shared/stamps/02.png',
                'created_at' => '2025-06-21 00:00:00',
                'updated_at' => '2025-06-21 00:00:00',
            ],
            [
                'id' => 3,
                'code' => 'GHS03',
                'path' => 'assets/images/shared/stamps/03.png',
                'created_at' => '2025-06-21 00:00:00',
                'updated_at' => '2025-06-21 00:00:00',
            ],
            [
                'id' => 4,
                'code' => 'GHS04',
                'path' => 'assets/images/shared/stamps/04.png',
                'created_at' => '2025-06-21 00:00:00',
                'updated_at' => '2025-06-21 00:00:00',
            ],
            [
                'id' => 5,
                'code' => 'GHS05',
                'path' => 'assets/images/shared/stamps/05.png',
                'created_at' => '2025-06-21 00:00:00',
                'updated_at' => '2025-06-21 00:00:00',
            ],
            [
                'id' => 6,
                'code' => 'GHS06',
                'path' => 'assets/images/shared/stamps/06.png',
                'created_at' => '2025-06-21 00:00:00',
                'updated_at' => '2025-06-21 00:00:00',
            ],
            [
                'id' => 7,
                'code' => 'GHS07',
                'path' => 'assets/images/shared/stamps/07.png',
                'created_at' => '2025-06-21 00:00:00',
                'updated_at' => '2025-06-21 00:00:00',
            ],
            [
                'id' => 8,
                'code' => 'GHS08',
                'path' => 'assets/images/shared/stamps/08.png',
                'created_at' => '2025-06-21 00:00:00',
                'updated_at' => '2025-06-21 00:00:00',
            ],
            [
                'id' => 9,
                'code' => 'GHS09',
                'path' => 'assets/images/shared/stamps/09.png',
                'created_at' => '2025-06-21 00:00:00',
                'updated_at' => '2025-06-21 00:00:00',
            ],
        ]);
    }
}
