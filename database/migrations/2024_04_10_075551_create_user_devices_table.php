<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('ip_address')->nullable();
            $table->string('platform_name')->nullable();
            $table->string('platform_version')->nullable();
            $table->string('device_name')->nullable();
            $table->string('device_version')->nullable();
            $table->string('browser_name')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('is_disabled')->default(0)->comment('0-allowed|1-disable device');
            $table->bigInteger('updated_user_id')->unsigned();
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
        Schema::dropIfExists('user_devices');
    }
}
