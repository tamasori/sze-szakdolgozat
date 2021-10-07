<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEwcCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ewc_codes', function (Blueprint $table) {
            $table->id();
            $table->string("code");
            $table->string("name");
            $table->string("short_name");
            $table->string("physical_form");
            $table->string("packaging_method");
            $table->string("expected_delivery_frequency");
            $table->string("h_property");
            $table->string("chemical_name_of_parts");
            $table->boolean("hazardous")->default(false);
            $table->string("type_of_hazard")->nullable();
            $table->string("origin");
            $table->string("technology_identifier_number");
            $table->string("teaor_codes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ewc_codes');
    }
}
