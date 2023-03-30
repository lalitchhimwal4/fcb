<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssigningAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigning_authorities', function (Blueprint $table) {
            $table->smallInteger('assigning_authority_number')->primary();
            $table->string('assigning_authority_code_description', 50);
            $table->string('assigning_authority_prefix', 2);
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
        Schema::dropIfExists('assigning_authorities');
    }
}
