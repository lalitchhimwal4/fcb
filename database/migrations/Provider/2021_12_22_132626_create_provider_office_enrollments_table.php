<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderOfficeEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_office_enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('office_system_id');
            $table->unsignedbigInteger('provider_system_id');
            $table->smallInteger('office_status')->default(1);
            $table->timestamps();
            $table->foreign('office_system_id')->references('id')->on('provider_offices');
            $table->foreign('provider_system_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_office_enrollments');
    }
}
