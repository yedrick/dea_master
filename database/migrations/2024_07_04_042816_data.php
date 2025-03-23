<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{

        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('table_name')->nullable();
            $table->string('model')->nullable();
            $table->string('singular')->nullable();
            $table->string('plural')->nullable();
            $table->enum('type', ['normal', 'child', 'subchild'])->default('normal');
            $table->integer('parent_id')->nullable();
            $table->timestamps();
        });

        Schema::create('fields',function(Blueprint $table){
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('order')->nullable()->default(0);
            $table->string('name');
            $table->string('trans_name');
            $table->enum('type', ['string','integer','decimal','text','select','password','email','url','image','file','barcode','map','color','radio','checkbox','date','array','score','hidden','child','subchild','field','custom','title','content'])->default('string');
            $table->enum('display_list', ['show', 'excel', 'none'])->default('show');
            $table->enum('display_item', ['show','none'])->default('show');
            $table->boolean('relation')->default(0);
            $table->boolean('required')->default(0);
            $table->string('label')->nullable();
            $table->string('placeholder')->nullable();

            $table->string('child_table')->nullable();
            $table->string('relation_cond')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_id')->references('id')->on('nodes')->onDelete('cascade');
        });

        Schema::create('field_options',function(Blueprint $table){
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('name');
            $table->string('label');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_id')->references('id')->on('fields')->onDelete('cascade');
        });

        Schema::create('filters',function(Blueprint $table){
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('name');
            $table->string('label');
            $table->string('operator');
            $table->string('field_name');
            $table->string('field_relation')->nullable();
            $table->string('value')->nullable();
            $table->string('type')->default('text');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_id')->references('id')->on('nodes')->onDelete('cascade');
        });

        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        //

    }
};
