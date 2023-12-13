<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* dodawanie domyślnego użytkownika */
        DB::table('users')->insert([
            'email' => 'kamilkrzywonos@gmail.com',
            'password' => '$2a$12$7eplkoGUtT1EObmF1gie.eqUcAwR4eMa9l0DOJt8do/25kpvV6Dxa',
            'email_verified_at' => '2022-10-01 00:00:00',
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
