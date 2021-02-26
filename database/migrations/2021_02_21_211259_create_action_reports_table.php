<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('client_id')
                ->nullable()
                ->constrained('clients')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->enum('action_type', ['NewArrival', 'Delivery']);
            $table->enum('u_o_m', ['PCS', 'PC']);
            $table->integer('quantity');
            $table->string('purchase_order')->nullable();
            $table->string('remarks')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_reports');
    }
}
