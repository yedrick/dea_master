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
        Schema::create('peoples', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('ci');
            $table->string('email');
            $table->string('phone_number');
            $table->enum('gender',['M','F']);
            $table->date('birth_date');

            $table->enum('assistant',['Creyente','Visitante']);
            $table->enum('membership',['Bautismo','Transferencia','Ninguno']);
            $table->date('date_membership');
            $table->string('church');
            $table->enum('dea',['Si','No']);

            $table->unsignedBigInteger('profession_id');
            $table->foreign('profession_id')->references('id')->on('professions')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('civil_status_id');
            $table->foreign('civil_status_id')->references('id')->on('civil_statuses')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('zone_id');
            $table->foreign('zone_id')->references('id')->on('zones')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('ministry_id');
            $table->foreign('ministry_id')->references('id')->on('ministries')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('membership_status_id');
            $table->foreign('membership_status_id')->references('id')->on('membership_status')->onUpdate('cascade')->onDelete('cascade');


            $table->string('image')->nullable();

            //indexes
            // $table->index('zone_id');
            // $table->index('profession_id');
            // $table->index('civil_status_id');
            // $table->index('membership_status_id');
            // $table->index('country_id');
            // $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peoples');
    }
};
