<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatitudeLongitudeToProviderOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provider_offices', function (Blueprint $table) {
            $table->string('latitude')->nullable()->after('social_media');
            $table->string('longitude')->nullable()->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provider_offices', function (Blueprint $table) {
             $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
