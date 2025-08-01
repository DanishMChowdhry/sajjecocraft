<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
           $table->id();
            $table->string('customer_name'); // Column for the customer name
            $table->string('order_id')->unique(); // Column for the order ID, ensuring it's unique
            $table->json('product_json'); // Column to store the product data in JSON format
            $table->string('total'); // Column for the total amount
            $table->string('status')->default('pending'); // Column for the status of the invoice
            $table->timestamps();
            $table->softDeletes(); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
