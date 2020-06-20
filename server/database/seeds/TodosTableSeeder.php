<?php

use Illuminate\Database\Seeder;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->insert([
            [
                'id' => '1',
                'user_id' => '1',
                'title' => 'title1',
                'detail' => 'detail1',
                'status' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '2',
                'user_id' => '1',
                'title' => 'title2',
                'detail' => 'detail2',
                'status' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '3',
                'user_id' => '2',
                'title' => 'title3',
                'detail' => 'detail3',
                'status' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => '北川博章',
                'email' => 'hirock17l@gmail.com',
                'password' => bcrypt('lochic89'),
            ]
        ]);
    }
}
