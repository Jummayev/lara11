<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system_message_translations', function (Blueprint $table) {
            $table->id();
            $table->string('language');
            $table->text('translation');
            $table->unsignedBigInteger('message_id');
            $table->index(['message_id', 'language']);
            $table->unique(['message_id', 'language']);
            $table->foreign('message_id')->references('id')->on('system_messages');
            $table->foreign('language')->references('code')->on('languages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_message_translations');
    }
};
