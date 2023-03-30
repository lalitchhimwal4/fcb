<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditRegistrationIdProvidersTable extends Migration
{
    public function up()
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->string('registration_id', 9)->change();
        });
    }

    public function down()
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->string('registration_id', 7)->change();
        });
    }
}
