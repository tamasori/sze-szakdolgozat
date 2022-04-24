<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetFieldsToNullabelInEwcCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ewc_codes', function (Blueprint $table) {
            $table->string('physical_form')->nullable()->change();
            $table->string('packaging_method')->nullable()->change();
            $table->string('h_property')->nullable()->change();
            $table->string('type_of_hazard')->nullable()->change();
            $table->string('chemical_name_of_parts')->nullable()->change();
        });
    }
}
