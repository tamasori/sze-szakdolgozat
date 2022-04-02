<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFromExportFieldToSubstances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('substances', function (Blueprint $table) {
            $table->boolean('from_export')->after("delivery_note")->default(false);
        });
    }
}
