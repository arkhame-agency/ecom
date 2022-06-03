<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCallToActionUrlColumnFromSliderSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slider_slides', function (Blueprint $table) {
            $table->dropColumn('call_to_action_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_url_column_from_slider_slides', function (Blueprint $table) {
            //
        });
    }
}
