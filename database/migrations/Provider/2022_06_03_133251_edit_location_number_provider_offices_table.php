<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditLocationNumberProviderOfficesTable extends Migration
{
    public function up()
    {
        Schema::table('provider_offices', function (Blueprint $table) {
            $table->string('location_number')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('provider_offices', function (Blueprint $table) {
            $table->string('location_number')->nullable(false)->change();
        });
    }
}
