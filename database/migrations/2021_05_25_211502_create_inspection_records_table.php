<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_records', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->foreignId("workshop_machinery_id")->constrained("workshop_machineries")->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId("inspector_id")->constrained("inspectors")->restrictOnDelete()->cascadeOnUpdate();
            $table->date("valid_till")->nullable();
            $table->string("result");
            $table->longText("note")->nullable();
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
        Schema::dropIfExists('inspection_records');
    }
}
