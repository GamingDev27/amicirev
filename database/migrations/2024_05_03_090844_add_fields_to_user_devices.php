<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUserDevices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_devices', function (Blueprint $table) {
            $table->string('uniqid')->nullable()->after('browser_version')->comment('unique id stored in cookie for verification');
            $table->dateTime('uniqid_expiry')->nullable()->after('uniqid')->comment('unique id duration stored in cookie for verification');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_devices', function (Blueprint $table) {
            $table->dropColumn(['uniqid', 'uniqid_expiry']);
        });
    }
}
