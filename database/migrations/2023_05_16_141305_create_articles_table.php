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
        Schema::create('articles', function (Blueprint $table) {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                //$table->foreignId('categories_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
                $table->string('title');
                $table->string('content');
                $table->string('keyword');
                $table->string('country');
                $table->string('city');
                //$table->foreignId('images_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
                //$table->foreignId('messengers_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
                $table->string('price');
                //$table->foreignId('interests_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
                //$table->foreignId('users_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
                //$table->foreignId('signalerabuses_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
                //$table->foreignId('socialnetworks_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
    
                $table->string('similar_ad');
                $table->string('devise');
                $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->default(0);
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
