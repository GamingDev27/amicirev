<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivestreamlinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livestreamlink', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('season_id');
            $table->string('name')->index();
            $table->text('description')->nullable();
            $table->dateTime('date_stream')->comment('stream date where the link will be available');
            $table->string('link', 250);
            $table->boolean('is_active')->default("0");
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
        Schema::dropIfExists('livestreamlink');
    }
}
