<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->index()->unique();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->integer('orders')->default(0)->nullable();
            $table->integer('brands')->default(0)->nullable();
            $table->integer('categories')->default(0)->nullable();
            $table->integer('products')->default(0)->nullable();
            $table->integer('sliders')->default(0)->nullable();
            $table->integer('coupons')->default(0)->nullable();
            $table->integer('shipping')->default(0)->nullable();
            $table->integer('users')->default(0)->nullable();
            $table->integer('blogs')->default(0)->nullable();
            $table->integer('sitesettings')->default(0)->nullable();
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
        Schema::dropIfExists('roles');
    }
}
