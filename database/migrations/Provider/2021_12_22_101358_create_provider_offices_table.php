<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('provider_offices', function (Blueprint $table) {
            $table->id();
            $table->string('location_number')->unique();
            $table->string('clinic_name');
            $table->string('address1');
            $table->string('address2');
            $table->string('city');
            $table->string('postal_code');
            $table->string('province');
            $table->string('country')->default('Canada');
            $table->string('website');
            $table->string('telephone')->unique();
            $table->string('fax');
            $table->string('email');
            $table->string('social_media');
            $table->unique(["clinic_name", "postal_code"], 'provider_clinic_unique_postal_code');
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
        Schema::dropIfExists('provider_offices');
    }
}
