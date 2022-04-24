<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspectors', function (Blueprint $table) {
            $table->id();
            $table->string("company")->nullable();
            $table->string("company_registration_number")->nullable();
            $table->string("name");
            $table->string("email")->nullable();
            $table->string("phone_number");
            $table->string("city");
            $table->string("street");
            $table->string("house_number");
            $table->string("vat_number")->nullable();
            $table->string("public_identifier_numbers");
            $table->longText("note")->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspectors');
    }
}
