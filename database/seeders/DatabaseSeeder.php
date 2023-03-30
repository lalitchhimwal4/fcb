<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(SpecialityCodesSeeder::class);
        $this->call(AssigningAuthoritiesSeeder::class);
        $this->call(EmailTemplateSeeder::class);
        $this->call(AccordiansSeeder::class);
        $this->call(CustomBoxesSeeder::class);
        $this->call(CmsPagesSeeder::class);
        $this->call(MasterTableForDefaultValuesSeeder::class);
        $this->call(NewsPublicationsSeeder::class);
    }
}
