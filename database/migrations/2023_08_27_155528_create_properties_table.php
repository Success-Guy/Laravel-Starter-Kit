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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('slug');
            $table->enum('type', ['let', 'sell', 'lease'])->default('let');
            $table->longText('description')->nullable();
            $table->unsignedDouble('price');
            $table->integer('discount')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->string('address')->nullable();
            $table->text('photos')->nullable();
            $table->enum('furnished',['none','semi','fully'])->default('none');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->index(['type', 'category_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
