<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialityCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_values = [
            1 => ['General Practitioner', '0'],
            2 => ['Public Health Dentist', '1'],
            3 => ['Endodontist', '2'],
            4 => ['Oral Pathologist', '3'],
            5 => ['Oral and Maxillofacial Surgeon', '4'],
            6 => ['Orthodontist', '5'],
            7 => ['Pedodontist', '6'],
            8 => ['Periodontist', '7'],
            9 => ['Radiologist', '8'],
            10 => ['Prosthodontist', '9'],
            11 => ['Anesthesiologist', 'A'],
            12 => ['Denturist', ''],
            99 => ['All Specialist', ''],
        ];

        foreach ($default_values as $i => $value) {
            $row = DB::table('speciality_codes')->where("speciality_code_number", $i)->first();
            if(isset($row)) {
                DB::table('speciality_codes')->where("speciality_code_number", $i)->update([
                    'speciality_code_description' => $value[0],
                    'speciality_sub_category_code' => $value[1],
                ]);
            } else {
                DB::table('speciality_codes')->insert([
                    'speciality_code_number' => $i,
                    'speciality_code_description' => $value[0],
                    'speciality_sub_category_code' => $value[1],
                ]);
            }
        }
    }
}
