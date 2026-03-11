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
        Schema::create('purchase_models', function (Blueprint $table) {
            $table->id();
            $table->integer("category_id")->comment('purcahse_category_model_id');
            $table->integer("subcategory_id")->comment('purcahse_subcategory_model_id');
            $table->text("detail");
            $table->decimal('amount',10,2);
            $table->date("date");
            $table->integer("purchased_by_id")->default(1)->comment('dummy id insertion');
            $table->integer("type")->comment('1 Purchase 2 sales');
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
        Schema::dropIfExists('purchase_models');
    }
};
