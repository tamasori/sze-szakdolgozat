<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("company")->nullable();
            $table->string("company_registration_number")->nullable();
            $table->string("name");
            $table->string("email")->nullable();
            $table->string("phone_number")->nullable();
            $table->string("city")->nullable();
            $table->string("street")->nullable();
            $table->string("house_number")->nullable();
            $table->string("vat_number")->nullable();
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
        Schema::dropIfExists('customers');
    }
}
