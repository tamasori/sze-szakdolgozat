<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbook_entries', function (Blueprint $table) {
            $table->id();
            $table->string('log_type');
            $table->string('check_type');
            $table->date('date');
            $table->longText('description');
            $table->longText('result');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
