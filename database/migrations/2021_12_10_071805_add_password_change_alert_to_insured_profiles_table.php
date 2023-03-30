<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasswordChangeAlertToInsuredProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insured_profiles', function (Blueprint $table) {
             $table->boolean('password_change_alert')->default(0)->after('longitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insured_profiles', function (Blueprint $table) {
           $table->dropColumn('password_change_alert');
        });
    }
}
