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
        Schema::create('youth_scores', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->integer('pts')->default(0);
            $table->unsignedBigInteger('youth_id');
            $table->foreign('youth_id')->references('id')->on('youths')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('type_score_id');
            $table->foreign('type_score_id')->references('id')->on('type_scores')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('youth_scores');
    }
};
