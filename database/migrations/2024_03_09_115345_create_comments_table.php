<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    : void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->foreignId('ticket_id')->constrained('tickets');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    : void
    {
        Schema::dropIfExists('comments');
    }
};
