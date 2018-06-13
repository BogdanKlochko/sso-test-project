<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'ADMIN'],
            ['name' => 'USER'],
        ]);

        DB::table('brokers')->insert([
            ['IP' => '192.197.0.1', 'secret' => 'qweasd'],
            ['IP' => '192.198.0.1', 'secret' => 'qweasd'],
        ]);
    }
}
