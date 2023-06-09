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
                $table->id();
                $table->string('title');
                $table->longText('content');
                $table->string('keyword');
                $table->string('country');
                $table->string('city');
                $table->double('price');
                $table->string('devise');   
                $table->boolean('negociation')->default(false);   
                $table->unsignedBigInteger('category_id');
                $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->default(0);
                $table->timestamps();
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
