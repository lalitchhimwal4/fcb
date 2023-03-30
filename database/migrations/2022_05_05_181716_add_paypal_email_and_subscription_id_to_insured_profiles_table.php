<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaypalEmailAndSubscriptionIdToInsuredProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('insured_profiles', function (Blueprint $table) {
            $table->string('paypal_email')->after('email');
            $table->string('paypal_subscription_id')->after('paypal_email');
        });
    }

    public function down()
    {
        Schema::table('insured_profiles', function (Blueprint $table) {
            $table->dropColumn('paypal_email');
            $table->dropColumn('paypal_subscription_id');
        });
    }
}
