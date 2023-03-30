<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderClaimDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('provider_claim_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('provider_claim_id');
            $table->string('service_code', 4);
            $table->text('description');
            $table->double('patient_pays_amount');
            $table->double('submitted_amount');
            $table->double('fcb_contracted_rate');
            $table->foreign('provider_claim_id')->references('id')->on('provider_claims');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table("provider_claim_details", function (Blueprint $table) {
            $table->dropForeign("provider_claim_details_provider_claim_id_foreign");
        });

        Schema::dropIfExists('provider_claim_details');
    }
}
