<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payors', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('payor_system_id');
            $table->string('policy_number',8)->default('20200001');
            $table->string('division_number',10)->default('001');
            $table->string('plan_number')->nullable();
            $table->string('effective_date')->nullable();
            $table->string('termination_date')->nullable();
            $table->string('company_name')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('registration_id',7)->unique();
            $table->string('password')->nullable();
            $table->integer('password_change_alert')->default('0');
            $table->string('website')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('contact_first_name')->nullable();
            $table->string('contact_designation')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_telephone')->nullable();
            $table->string('contact_telephone_ext')->nullable();
            $table->string('contact_fax')->nullable();
            $table->string('rep_company_name')->nullable();
            $table->string('rep_last_name')->nullable();
            $table->string('rep_first_name')->nullable();
            $table->string('rep_designation')->nullable();
            $table->string('rep_email')->nullable();
            $table->string('rep_telephone')->nullable();
            $table->string('rep_telephone_ext')->nullable();
            $table->string('rep_fax')->nullable();
            $table->string('rep_website')->nullable();
            $table->string('rep_address1')->nullable();
            $table->string('rep_address2')->nullable();
            $table->string('rep_city')->nullable();
            $table->string('rep_province')->nullable();
            $table->string('rep_country')->nullable();
            $table->string('rep_postal_code')->nullable();
            $table->string('payor_invoice_run_day')->nullable();
            $table->string('billing_type')->nullable();
            $table->string('insured_signal_pre_rate')->nullable();
            $table->string('insured_family_pre_rate')->nullable();
            $table->string('claim_percentage_rate')->nullable();
            $table->smallInteger('invoice_rate')->nullable();
            $table->string('remember_token')->nullable();
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
        Schema::dropIfExists('payors');
    }
}
