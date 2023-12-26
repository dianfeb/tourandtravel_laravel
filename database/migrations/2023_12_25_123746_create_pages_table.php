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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('img');
            $table->longText('desc')->nullable();
            $table->enum('delete', ['No', 'Yes'])->nullable();
            $table->enum('type', ['Name','Name & Text','Name & Desc','Name & Images','Desc & Images','Images','Information', 'Information & Images'])->nullable();
            $table->enum('status', ['Off', 'On'])->nullable();
            $table->enum('show', ['No', 'Yes'])->nullable();
            $table->string('title')->nullable();
            $table->char('keyword')->nullable();
            $table->longText('description')->nullable();
            $table->longText('information')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
