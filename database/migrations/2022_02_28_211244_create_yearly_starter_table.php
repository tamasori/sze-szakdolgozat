<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYearlyStarterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yearly_starters', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->foreignId("ewc_code_id")->nullable()->constrained("ewc_codes")->nullOnDelete()->cascadeOnUpdate();
            $table->float("mass")->nullable()->default(0);
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
        Schema::dropIfExists('yearly_starter');
    }
}
