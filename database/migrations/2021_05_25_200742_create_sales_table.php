<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->foreignId("part_id")->constrained("parts")->restrictOnDelete()->cascadeOnUpdate();
            $table->float("weight");
            $table->foreignId("quality_id")->constrained("qualities")->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId("car_id")->nullable()->constrained("cars")->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId("created_by")->nullable()->constrained("users")->restrictOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('sales');
    }
}
