<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('substances', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->foreignId("ewc_code_id")->constrained("ewc_codes","id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("car_id")->nullable()->constrained("cars","id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->text("part_name")->nullable();
            $table->float("mass")->nullable();
            $table->float("export_mass")->nullable();
            $table->float("pretreatment_mass")->nullable();
            $table->float("disposal_mass")->nullable();
            $table->text("company_name")->nullable();
            $table->text("kuj_number")->nullable();
            $table->text("ktj_number")->nullable();
            $table->text("treatment_code")->nullable();
            $table->text("delivery_note")->nullable();
            $table->boolean("in_material_balance")->default(false);
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
        Schema::dropIfExists('substances');
    }
}
