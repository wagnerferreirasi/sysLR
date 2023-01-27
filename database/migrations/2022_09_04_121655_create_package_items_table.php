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
        Schema::create('package_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->decimal('value', 10, 2)->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->boolean('pay_on_delivery')->default(false)->nullable();
            $table->float('weight');
            $table->float('width');
            $table->float('height');
            $table->float('length');
            $table->text('observations')->nullable();
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
        Schema::dropIfExists('package_items');
    }
};
