<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEmailLogRecipientTableAddStatusColumn extends Migration
{
    public function up()
    {
        Schema::table('email_log_recipient', function (Blueprint $table) {
            $table->string('status')->nullable();
        });
    }

    public function down()
    {
        Schema::table('email_log_recipient', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}