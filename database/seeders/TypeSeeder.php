<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('types')->insert([
            [
                'id' => 1,
                'jenis' => 'AYAM',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 2,
                'jenis' => 'DAGING SAPI & KAMBING',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 3,
                'jenis' => 'IKAN / SEAFOOD',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 4,
                'jenis' => 'SAYURAN',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 5,
                'jenis' => 'CAKE',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 6,
                'jenis' => 'ROTI DAN FILLING',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 7,
                'jenis' => 'JAJANAN PASAR',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 8,
                'jenis' => 'GORENGAN',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'created_at' => today(),
                'updated_at' => today(),
            ]
        ]);
    }
}
