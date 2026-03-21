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
        Schema::create('seva_pooja_receipt_details', function (Blueprint $table) {
            $table->id();
            $table->integer("seva_pooja_receipt_id");
            $table->integer("pooja_id");
            $table->string("pooja_code");
            $table->text("pooja_name");
            $table->integer("qty");
            $table->decimal('price',10,2);
            $table->decimal('total',10,2);
            $table->integer("category_id");
            $table->integer("subcategory_id");
            $table->integer("financial_year_id");
            $table->date("receipt_date");
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
        Schema::dropIfExists('seva_pooja_receipt_details');
    }
};
