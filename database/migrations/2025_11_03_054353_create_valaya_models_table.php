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
        Schema::create('valaya_models', function (Blueprint $table) {
            $table->id();
            $table->string('valaya_no');
            $table->string('name');
            $table->boolean('status')->default(1);
            $table->integer('is_edit')->default(0); // 0 => Edit,  1=> Can't Edit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valaya_models');
    }
};
