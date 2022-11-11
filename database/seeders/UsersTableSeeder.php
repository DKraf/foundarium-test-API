<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

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
            'first_name' => "Dmitriy",
            'last_name'  => 'Kravchenko',
            'email'      => 'dkraf9006@gmail.com',
            'phone'      => '+7(771)472-45-30',
            'password'   => Hash::make('1q2w3e4r'),
            'role'       => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
    }
}
