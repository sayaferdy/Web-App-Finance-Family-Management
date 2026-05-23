<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [

            // INCOME
            [
                'name' => 'Gaji',
                'type' => 'income'
            ],

            [
                'name' => 'Bonus',
                'type' => 'income'
            ],

            [
                'name' => 'Penjualan Ayam',
                'type' => 'income'
            ],

            // EXPENSE
            [
                'name' => 'Belanja Dapur',
                'type' => 'expense'
            ],

            [
                'name' => 'Listrik',
                'type' => 'expense'
            ],

            [
                'name' => 'Wifi',
                'type' => 'expense'
            ],

            [
                'name' => 'Makan',
                'type' => 'expense'
            ],

            [
                'name' => 'Transport',
                'type' => 'expense'
            ],

            [
                'name' => 'Hiburan',
                'type' => 'expense'
            ],

            [
                'name' => 'Pakan Ayam',
                'type' => 'expense'
            ],

            [
                'name' => 'Obat Ayam',
                'type' => 'expense'
            ]
        ];

        $this->db->table('categories')->insertBatch($data);
    }
}