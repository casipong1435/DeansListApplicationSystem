<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            [
                'username' => 'registrar',
                'first_name' => 'registrar',
                'last_name' => 'office',
                'password' => Hash::make('@registrarOffice'),
                'plain_password' => '@registrarOffice',
                'office' => 1,
                'role' => 2
            ],
            [
                'username' => 'vpacademic',
                'first_name' => 'VP for',
                'last_name' => 'Academic Affairs',
                'password' => Hash::make('@VPAcademic'),
                'plain_password' => '@VPAcademic',
                'office' => 2,
                'role' => 2
            ],
            [
                'username' => 'icsdean',
                'first_name' => 'ICS',
                'last_name' => 'Dean',
                'password' => Hash::make('@ICSDean'),
                'plain_password' => '@ICSDean',
                'office' => 3,
                'role' => 2
            ],
            [
                'username' => 'iasdean',
                'first_name' => 'IAS',
                'last_name' => 'Dean',
                'password' => Hash::make('@IASDean'),
                'plain_password' => '@IASDean',
                'office' => 6,
                'role' => 2
            ],
            [
                'username' => 'ibfsdean',
                'first_name' => 'IBFS',
                'last_name' => 'Dean',
                'password' => Hash::make('@IBFSDean'),
                'plain_password' => '@IBFSDean',
                'office' => 4,
                'role' => 2
            ],
            [
                'username' => 'ihsdean',
                'first_name' => 'IHS',
                'last_name' => 'Dean',
                'password' => Hash::make('@IHSDean'),
                'plain_password' => '@IHSDean',
                'office' => 7,
                'role' => 2
            ],
            [
                'username' => 'itedean',
                'first_name' => 'ITE',
                'last_name' => 'Dean',
                'password' => Hash::make('@ITEDean'),
                'plain_password' => '@ITEDean',
                'office' => 5,
                'role' => 2
            ],
            [
                'username' => 'icjedean',
                'first_name' => 'ICJE',
                'last_name' => 'Dean',
                'password' => Hash::make('@ICJEDean'),
                'plain_password' => '@ICJEDean',
                'office' => 8,
                'role' => 2
            ],
        ];

        User::insert($values);
    }
}
