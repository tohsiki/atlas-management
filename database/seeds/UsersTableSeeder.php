<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'over_name' => 'Atlas',
            'under_name' => '一郎',
            'over_name_kana' => 'アトラス',
            'under_name_kana' => 'イチロウ',
            'mail_address' => '12345@gmail.com',
            'sex' => '1',
            'birth_day' => '2007-09-05',
            'role' => '2',
            'password' => bcrypt('1234567'),
            ]);
    }
}
