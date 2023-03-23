<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliceStationReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('police_station_reports', function (Blueprint $table) {
            $table->id();
            $table->string('barangay');
            $table->string('street')->nullable();
            $table->string('police_substation');

            $table->string('complainant_id')->nullable();
            $table->string('complainant_name')->nullable();
            $table->string('complainant_address')->nullable();
            $table->string('complainant_gender')->nullable();
            $table->string('complainant_age')->nullable();
            $table->string('complainant_contact')->nullable();
            $table->string('complainant_email')->nullable();
            $table->string('complainant_identity')->nullable(); //anonymous or not

            $table->string('report_details', 5000)->nullable();

            $table->string('report_images_1')->nullable();
            $table->string('report_images_2')->nullable();
            $table->string('report_images_3')->nullable();

            $table->string('report_status')->nullable();

            $table->date('date_reported');
            $table->time('time_reported');
            $table->string('year_reported')->nullable();
            $table->date('date_commited');
            $table->time('time_commited');
            $table->string('incident_type');



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
        Schema::dropIfExists('police_station_reports');
    }
}
