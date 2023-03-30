<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterTableForDefaultValuesSeeder extends Seeder
{
    public function run()
    {
        $default_values = [
            [
                'table_name' => 'members',
                'column_name' => 'relationship',
                'keys_values' => '{"0":"Primary Insured","1":"Spouse","2":"Dependent","3":"Parents","4":"Guest","5":"Partner","6":"Other"}',
            ],
            [
                'table_name' => 'members',
                'column_name' => 'account_status',
                'keys_values' => '{"1":"Active","2":"Inactive"}',
            ],
            [
                'table_name' => 'providers',
                'column_name' => 'account_status',
                'keys_values' => '{"1":"Active","2":"Inactive"}',
            ],
            [
                'table_name' => 'provider_office_enrollments',
                'column_name' => 'office_status',
                'keys_values' => '{"1":"Active","2":"Inactive"}',
            ],
        ];

        foreach ($default_values as $i => $value) {
            $row = DB::table('mastertable_for_defaultvalues')->where("table_name", $value['table_name'])->where('column_name', $value['column_name'])->first();
            if (isset($row)) {
                $row = DB::table('mastertable_for_defaultvalues')->where("table_name", $value['table_name'])->where('column_name', $value['column_name'])->update([
                    'keys_values' => $value['keys_values'],
                ]);
            } else {
                DB::table('mastertable_for_defaultvalues')->insert([
                    'table_name' => $value['table_name'],
                    'column_name' => $value['column_name'],
                    'keys_values' => $value['keys_values'],
                ]);
            }
        }
    }
}
