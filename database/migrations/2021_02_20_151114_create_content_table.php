<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('details');
            $table->string('image_name');
            $table->string('attachment');
            $table->string('type');
            $table->Integer('display_order');
            $table->boolean('date_published');
            $table->boolean('enabled');
            $table->foreign('auth_user_id')->references('id')->on('users');
			$table->bigInteger('auth_user_id')->unsigned();
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
        Schema::dropIfExists('content');
    }
}
