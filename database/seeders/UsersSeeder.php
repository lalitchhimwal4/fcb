<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'Admin@123';
        $password = Hash::make($password);
        $email_verified_at = date('Y-m-d h:i:s', time());

        $row = User::where('email', 'admin@admin.com')->first();

        if (isset($row)) {
            $row->name = 'Admin';
            $row->email = 'admin@admin.com';
            $row->email_verified_at = $email_verified_at;
            $row->password = $password;
            $row->save();
        } else {
            User::create(['name' => 'Admin', 'email' => 'admin@admin.com', 'email_verified_at' => $email_verified_at, 'password' => $password]);
        }
    }
}
