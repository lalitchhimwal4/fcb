<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('license_number')->unique();
            $table->string('registration_id', 7)->unique();
            $table->string('password');
            $table->date('registration_date');
            $table->string('registration_method')->default("Online");
            $table->smallInteger('assigning_authority_number');
            $table->string('last_name');
            $table->string('first_name');
            $table->smallInteger('account_status')->default(1);
            $table->smallInteger('speciality_code_number');
            $table->boolean('password_change_alert')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('assigning_authority_number')->references('assigning_authority_number')->on('assigning_authorities');
            $table->foreign('speciality_code_number')->references('speciality_code_number')->on('speciality_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
}
