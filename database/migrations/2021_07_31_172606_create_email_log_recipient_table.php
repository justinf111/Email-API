<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailLogRecipientTable extends Migration
{
    public function up()
    {
        Schema::create('email_log_recipient', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('recipient_id');
            $table->unsignedInteger('email_log_id');
            $table->foreign('email_log_id')->references('id')->on('email_logs');
            $table->foreign('recipient_id')->references('id')->on('recipients');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_log_recipient');
    }
}