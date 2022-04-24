<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHazardousReactionsToEwcCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ewc_codes', function (Blueprint $table) {
            $table->string('hazardous_reactions')->nullable();
        });
    }
}
