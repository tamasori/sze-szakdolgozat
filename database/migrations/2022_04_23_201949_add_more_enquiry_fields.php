<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreEnquiryFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->foreignId("mechanic_id")->after("note")->nullable()->constrained("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->text("answer")->nullable()->after("note");
            $table->dateTime("closed_at")->nullable()->after("note");
            $table->dateTime("doable_at")->nullable()->after("note");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn("");
            $table->dropConstrainedForeignId("mechanic_id");
            $table->dropColumn("closed");
            $table->dropColumn("answer");
        });
    }
}
