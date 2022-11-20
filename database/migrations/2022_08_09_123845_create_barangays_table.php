<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->string('barangay_name');
            $table->string('barangay_captain');
            $table->string('barangay_location');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('barangay_schedule');
            $table->string('barangay_contact');
            $table->string('img');
            $table->string('user_id');
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
        Schema::dropIfExists('barangays');
    }
}
