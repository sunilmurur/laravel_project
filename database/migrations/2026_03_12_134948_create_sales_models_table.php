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
        Schema::create('sales_models', function (Blueprint $table) {
            $table->id();
            $table->integer("category_id")->comment('purcahse_category_model_id');
            $table->integer("subcategory_id")->comment('purcahse_subcategory_model_id');
            $table->text("detail");
            $table->date("date");
            $table->integer("purcahse_types_id")->comment('from purcahse types id');
            $table->decimal("quantity",10,2)->comment('');
            $table->integer("financial_year_id");
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
        Schema::dropIfExists('sales_models');
    }
};
