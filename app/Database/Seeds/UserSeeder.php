<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'       => 'Administrator',
                'username'   => 'admin',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 'superadmin',
                'created_at' => date('Y-m-d H:i:s')
            ],

            [
                'name'       => 'Ayah',
                'username'   => 'ayah',
                'password'   => password_hash('123456', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s')
            ],

            [
                'name'       => 'Ibu',
                'username'   => 'ibu',
                'password'   => password_hash('123456', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s')
            ],

            [
                'name'       => 'Ferdy',
                'username'   => 'perdi',
                'password'   => password_hash('123456', PASSWORD_DEFAULT),
                'role'       => 'member',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}