<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmails = [
            '67121923@g.cmru.ac.th',
            '67121946@g.cmru.ac.th',
            '67121953@g.cmru.ac.th',
            '67121954@g.cmru.ac.th',
            '67121961@g.cmru.ac.th',
        ];

        foreach ($adminEmails as $email) {
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name'       => 'Admin ' . explode('@', $email)[0],
                    'password'   => Hash::make('123456789'),
                    'phone'      => '0000000000',
                    'address'    => 'Admin Address',
                    'experience' => 'N/A',
                    'reason'     => 'System Admin Account', // เพิ่มฟิลด์ reason
                    'role'       => 'admin',
                    'is_admin'   => true,
                    'pet_id'     => null,
                ]
            );
        }
    }
}