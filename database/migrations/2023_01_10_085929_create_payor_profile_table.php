<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayorProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payor_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('address1');
            $table->string('address2');
            $table->string('city');
            $table->string('postal_code');
            $table->string('province');
            $table->string('country')->default('Canada');
            $table->string('telephone')->unique();
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payor_profiles');
    }
}
