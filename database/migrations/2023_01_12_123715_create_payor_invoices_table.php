<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayorInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('payor_invoices')){
        Schema::create('payor_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_system_id')->nullable();
            $table->integer('payor_system_id')->index();
            //$table->unsignedbigInteger('payor_system_id')->index()->nullable();
            $table->foreign('payor_system_id')->references('id')->on('payors');
            $table->string('invoice_run_date')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('invoice_period_start')->nullable();
            $table->string('invoice_period_end')->nullable();
            $table->string('single_insured_count')->nullable();
            $table->string('family_insured_count')->nullable();
            $table->string('claim_count')->nullable();
            $table->string('insured_single_pre_rate')->nullable();
            $table->string('insured_family_pre_rate')->nullable();
            $table->string('percentage_rate')->nullable();
            $table->string('single_insured_fee')->nullable();
            $table->string('family_insured_fee')->nullable();
            $table->string('claim_fee')->nullable();
            $table->string('tax_rate')->nullable();
            $table->string('invoice_total_gross_amount')->nullable();
            $table->string('invoice_total_tax_amount')->nullable();
            $table->string('invoice_total_net_amount')->nullable();
            $table->string('invoice_status')->nullable();
            $table->timestamps();
            
        });
    }
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payor_invoices');
    }
}
