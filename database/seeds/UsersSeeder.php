<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fullname' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$vVH3fC46QK75mAIbI.QsKuLEWzDJdFnrj96eO.zges2ERFvLgKxOq',
            'phone' => '096xxxxxxx',
            'office_id' => '',
            'role_id' => '1',
            'status' => '1',
        ]);
    }
}
