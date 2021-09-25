<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Test extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('subsubcategory_id')->nullable();

            $table->string('product_name_en');
            $table->string('product_name_ph');
            $table->string('product_slug_en');
            $table->string('product_slug_ph');
            $table->string('product_code')->unique();
            $table->string('product_qty');
            $table->string('product_tags_en');
            $table->string('product_tags_ph');

            $table->string('product_size_en')->nullable();;
            $table->string('product_size_ph')->nullable();;

            $table->string('product_color_en');
            $table->string('product_color_ph');

            $table->string('product_prize');
            $table->string('product_discount')->nullable();;

            $table->string('product_descp_short_en');
            $table->string('product_descp_short_ph');

            $table->text('product_descp_long_en');
            $table->text('product_descp_long_ph');

            $table->string('product_thumbnail');

            $table->integer('ishot_deals')->nullable();
            $table->integer('isfeatured')->nullable();
            $table->integer('isspecialoffer')->nullable();
            $table->integer('isspecialdeals')->nullable();
            $table->integer('product_status')->default(0)->nullable();

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
        Schema::dropIfExists('products');
    }
}
