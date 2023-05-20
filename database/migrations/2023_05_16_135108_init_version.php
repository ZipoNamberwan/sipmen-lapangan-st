<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subdistrict', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('code');
            $table->string('long_code');
            $table->string('name');
            $table->foreignId('user_id')->nullable()->constrained('users');
        });
        Schema::create('village', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('code');
            $table->string('long_code');
            $table->string('name');
            $table->foreignId('subdistrict_id')->constrained('subdistrict');
        });
        Schema::create('sls', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('code');
            $table->string('long_code');
            $table->string('name');
            $table->foreignId('village_id')->constrained('village');
        });
        Schema::create('receiving', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->boolean('map');
            $table->boolean('l1');
            $table->integer('l2');
            $table->date('date');
            $table->string('sender')->nullable();
            $table->string('note')->nullable();
            $table->foreignId('sls_id')->constrained('sls')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
        Schema::create('box', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->integer('number');
            $table->timestamps();
        });
        Schema::create('batching', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->foreignId('box_id')->constrained('box');
            $table->date('date');
            $table->string('from')->nullable();
            $table->string('note')->nullable();
            $table->foreignId('subdistrict_id')->constrained('subdistrict')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
