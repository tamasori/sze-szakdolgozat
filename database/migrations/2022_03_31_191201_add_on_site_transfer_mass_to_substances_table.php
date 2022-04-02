<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOnSiteTransferMassToSubstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('substances', function (Blueprint $table) {
            $table->float("on_site_transfer_mass")->default(0)->nullable();
        });
    }

}
