<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string("local_identifier")->unique();
            $table->foreignId("car_model_id")->constrained("car_models")->restrictOnDelete()->cascadeOnUpdate();
            $table->year("year");
            $table->integer("engine_ccm")->nullable();
            $table->string("vin")->nullable();
            $table->string("engine_code")->nullable();
            $table->float("power")->nullable();
            $table->foreignId("color_id")->nullable()->constrained("colors")->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId("fuel_type_id")->nullable()->constrained("fuel_types")->restrictOnDelete()->cascadeOnUpdate();
            $table->float("own_weight");
            $table->float("retrieved_weight");
            $table->float("dry_weight");
            $table->date("date_of_demolition");
            $table->string("demolition_certificate_number");
            $table->longText("note")->nullable();
            $table->foreignId("created_by")->nullable()->constrained("users")->nullOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('cars');
    }
}
