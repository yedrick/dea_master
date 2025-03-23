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
        //menu
        Schema::create('menus', function (Blueprint $table) {
            // $table->increments('id');
            $table->unsignedInteger('id')->primary();
            $table->string('name')->unique();
            $table->string('label')->nullable();
            $table->boolean('is_multi')->default(false);
            $table->boolean('is_node')->default(true);
            $table->integer('order')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('icon')->nullable();
            $table->string('permission')->nullable();
            $table->string('role')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('menus');
    }
};
