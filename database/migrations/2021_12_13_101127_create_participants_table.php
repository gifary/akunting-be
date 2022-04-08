<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name',150);
            $table->string('nip',20)->unique();
            $table->string('email',150)->nullable();
            $table->string('phone_country_code',6)->default("+62");
            $table->string('phone',20)->unique();
            $table->decimal('unique_code',5,2)->unique();
            $table->integer('billing_cycle');
            $table->date('birth_date')->nullable();
            $table->enum("gender",['ikhwan','akhwat']);
            $table->enum("status",['active','inactive']);

            $table->timestamps();
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
        Schema::dropIfExists('participants');
    }
}
