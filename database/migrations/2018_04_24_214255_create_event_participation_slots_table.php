<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventParticipationSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_participation_slots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eventid');
            $table->integer('slotid');
            $table->string('emailid');
            $table->boolean('response')->default(false);
            // $table->primary(['eventid','emailid','slotid']);
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
        Schema::dropIfExists('event_participation_slots');
    }
}
