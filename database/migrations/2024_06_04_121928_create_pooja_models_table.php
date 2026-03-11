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
        Schema::create('pooja_models', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id'); 
            $table->integer('subcategory_id'); 
            $table->text("pooja_name");
            $table->integer('code'); 
            $table->text("pooja_description");
            $table->float('amount'); 
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
        Schema::dropIfExists('pooja_models');
    }
};
