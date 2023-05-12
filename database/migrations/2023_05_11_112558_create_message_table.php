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
        Schema::create('message', function (Blueprint $table) {
            $table->increments(column:'id');
            $table->integer(column:'from_id')->unsigned();
            $table->integer(column:'article_id')->unsigned();
            //$table-> foreign(columns:'from_id',name:'from')->references('id')->on('users')->onDelete('cascade');
            //$table-> foreign(columns:'to_id',name:'to')->references('id')->on('users')->onDelete('cascade');
            $table-> text(column:'content');
            $table->timestamp(column:'created_at')->useCurrent();
            $table->dateTime(column:'read_at');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message');
    }
};
