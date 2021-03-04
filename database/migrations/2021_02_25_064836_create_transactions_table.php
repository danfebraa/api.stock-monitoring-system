<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->nullable()
                ->constrained('clients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->enum('action_type', ['NewArrival', 'Delivery']);
            $table->string('purchase_order')->nullable();
            $table->string('remarks')->nullable();
            $table->double('total_amount', 8, 2)->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
