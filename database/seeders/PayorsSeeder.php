<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PayorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payors')->insert([
            'plan_number' => 'A013',
            'division_number' => '001',
            'registration_id' => 'PY00001',
            'password' => Hash::make('password'),
            'company_name' => Str::random(10),
            'contact_email' => Str::random(10).'@gmail.com',
            'rep_email' => Str::random(10).'@gmail.com',
            'contact_telephone' => '9999999999',
        ]);
    }
}
