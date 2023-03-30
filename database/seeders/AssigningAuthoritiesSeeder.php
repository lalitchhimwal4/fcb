<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssigningAuthoritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_values = [
            1 => ['Dental Provider/Specialist', 'DD'],
            2 => ['Acupuncturist', 'AP'],
            3 => ['Audiologists/Hearing', 'AH'],
            4 => ['Chiropodist', 'CD'],
            5 => ['Chiropractor', 'CT'],
            6 => ['Clinical Psychologist', 'CP'],
            7 => ['Massage Therapist', 'MT'],
            8 => ['Naturopath', 'NT'],
            9 => ['Occupational Therapist', 'OT'],
            10 => ['Osteopath', 'OS'],
            11 => ['Physiotherapist', 'PT'],
            12 => ['Speech Therapist', 'ST'],
            13 => ['Optometrist', 'OP'],
        ];

        foreach ($default_values as $i => $value) {
            $row = DB::table('assigning_authorities')->where("assigning_authority_number", $i)->first();
            if (isset($row)) {
                DB::table('assigning_authorities')->where("assigning_authority_number", $i)->update([
                    'assigning_authority_code_description' => $value[0],
                    'assigning_authority_prefix' => $value[1],
                ]);
            } else {
                DB::table('assigning_authorities')->insert([
                    'assigning_authority_number' => $i,
                    'assigning_authority_code_description' => $value[0],
                    'assigning_authority_prefix' => $value[1],
                ]);
            }
        }
    }
}
