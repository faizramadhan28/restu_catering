<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'id' => 1,
                'menu' => 'Nasi Bakar',
                'harga' => 15000,
                'desc' => 'ini nasi bakar',
                'image' => 'NASI_BAKAR.jpg',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 2,
                'menu' => 'Nasi Goreng',
                'harga' => 20000,
                'desc' => 'ini nasi goreng',
                'image' => 'NASI_GORENG.jpg',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 3,
                'menu' => 'Nasi Uduk',
                'harga' => 15000,
                'desc' => 'ini nasi uduk',
                'image' => 'NASI_UDUK.jpg',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 4,
                'menu' => 'Bubur Ayam',
                'harga' => 10000,
                'desc' => 'ini bubur ayam',
                'image' => 'BUBUR_AYAM.jpg',
                'created_at' => today(),
                'updated_at' => today(),
            ]
        ]);
    }
}
