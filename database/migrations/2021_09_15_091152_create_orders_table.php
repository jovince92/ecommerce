<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();            
            $table->unsignedBigInteger('city_id')->index();
            $table->unsignedBigInteger('state_id')->index();
            $table->unsignedBigInteger('country_id')->index();
            $table->string('name');
            $table->string('address_line');
            $table->string('email');
            $table->string('phone');
            $table->string('postcode');
            $table->text('notes')->nullable();
            $table->string('payment_type');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->index();
            $table->string('currency');
            $table->double('amount');
            $table->string('order_number');
            $table->string('invoice_number');
            $table->string('order_date');
            $table->string('confirmation_date')->nullable();
            $table->string('processing_date')->nullable();
            $table->string('pickup_date')->nullable();
            $table->string('shipping_date')->nullable();
            $table->string('delivered_date')->nullable();
            $table->string('canceled_date')->nullable();
            $table->string('returned_date')->nullable();
            $table->string('return_reason')->nullable();
            $table->unsignedBigInteger('status')->index();
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
        Schema::dropIfExists('orders');
    }
}

