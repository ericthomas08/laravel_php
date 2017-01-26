<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admin')->insert([
            'email' => 'admin@admin.com',
            'salt' => 'abcdefgh',
            'secure_key' => md5('abcdefghadminadmin'),
        ]);
    }
}
