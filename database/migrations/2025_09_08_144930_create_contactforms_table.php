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
        Schema::create('contactforms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('needs')->nullable();
            $table->string('needs_other')->nullable();
            $table->boolean('has_website')->nullable();
            $table->string('existing_website')->nullable();
            $table->text('website_likes')->nullable();
            $table->text('website_dislikes')->nullable();
            $table->string('webshop_products')->nullable();
            $table->string('webshop_location')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactforms');
    }
};
