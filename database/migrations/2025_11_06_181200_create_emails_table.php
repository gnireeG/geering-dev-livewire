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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('subject');
            $table->text('recipients')->nullable();
            $table->string('cc')->nullable();
            $table->string('bcc')->nullable();
            $table->text('body')->nullable();
            $table->text('body_text')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('emails')->onDelete('set null');
            $table->enum('status', ['draft', 'sent', 'failed'])->default('draft');
            $table->enum('reply_status', ['no_reply', 'replied'])->default('no_reply');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
