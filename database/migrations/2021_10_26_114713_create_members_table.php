<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('insured_profile_id');
            $table->string('carrier_number',6)->default('000126');
            $table->string('policy_number',8)->default('20200001');
            $table->string('division_number',10)->default('001');
            $table->string('member_number',11)->unique();
            $table->integer('family_number');
            $table->string('registration_id',7)->unique();
            $table->string('password');
            $table->date('registration_date');
            $table->string('registration_method')->default("Online");
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('gender',1)->comment('0=>Male, 1=>Female');
            $table->string('relationship',1)->comment('0=>Primary Insured, 1=>Spouse, 2=>Dependent, 3=>Parents, 4=>Guest, 5=>Partner, 6=>Other');
            $table->integer('payor_number')->default(1);
            $table->smallInteger('account_status')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('insured_profile_id')->references('id')->on('insured_profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
