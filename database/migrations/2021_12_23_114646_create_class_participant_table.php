<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_participants', function (Blueprint $table) {
            $table->foreignUuid('classes_id')->constrained('classes');
            $table->foreignUuid('participant_id')->constrained('participants');
            $table->boolean('is_active')->default(true);
            $table->primary(['classes_id','participant_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_participant', function (Blueprint $table) {
            //
        });
    }
}
