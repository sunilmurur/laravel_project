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
            $table->integer("is_grocery_selected")->comment('Akki,Kai, Oil Selected or not');
            $table->integer("purcahse_types_id")->comment('from purcahse types id');
            $table->integer("quantity")->comment('');
            $table->integer("financial_year_id");
            $table->integer("customer_id")->nullable()->comment('customer model');
            $table->integer("is_donation_selected")->comment('Akki,Kai, Oil Donation Selected or not');
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
