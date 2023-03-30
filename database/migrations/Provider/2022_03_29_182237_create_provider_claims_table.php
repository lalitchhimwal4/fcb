<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderClaimsTable extends Migration
{
    public function up()
    {
        Schema::create('provider_claims', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number');
            $table->unsignedbigInteger('provider_id');
            $table->unsignedbigInteger('member_id');
            $table->double('patient_pays_amount');
            $table->double('submitted_amount');
            $table->double('fcb_contracted_rate');
            $table->date('processed_date');
            $table->boolean('failed_payment')->default(false);
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->foreign('member_id')->references('id')->on('members');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table("provider_claims", function (Blueprint $table) {
            $table->dropForeign("provider_claims_provider_id_foreign");
            $table->dropForeign("provider_claims_member_id_foreign");
        });

        Schema::dropIfExists('provider_claims');
    }
}
