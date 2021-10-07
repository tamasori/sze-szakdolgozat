<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopMachineriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_machineries', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("local_identifier");
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
        Schema::dropIfExists('workshop_machineries');
    }
}
