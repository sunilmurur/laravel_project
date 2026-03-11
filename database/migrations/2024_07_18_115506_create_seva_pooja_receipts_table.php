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
        Schema::create('seva_pooja_receipts', function (Blueprint $table) {
            $table->id();
            $table->string("receipt_no");
            $table->integer("user_id");
            $table->integer("payment_method_id");
            $table->date("receipt_date");
            $table->time("receipt_time");
            $table->decimal('grand_total',10,2);
            $table->integer("financial_year_id");
            $table->text("bill_desc");
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
        Schema::dropIfExists('seva_pooja_receipts');
    }
};
