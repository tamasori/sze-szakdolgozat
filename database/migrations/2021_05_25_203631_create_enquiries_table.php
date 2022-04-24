<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId("part_id")->constrained("parts")->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId("car_model_id")->constrained("car_models")->restrictOnDelete()->cascadeOnUpdate();
            $table->year("car_year");
            $table->foreignId("customer_id")->constrained("customers")->restrictOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('enquiries');
    }
}
