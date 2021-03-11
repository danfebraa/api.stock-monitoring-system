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

            $table->foreignId('supplier_id')
                ->nullable()
                ->constrained('suppliers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->enum('action_type', ['Return to Warehouse', 'Goods Receipt', 'Positive Adjust', 'Goods Issue', 'Return to Supplier', 'Negative Adjust']);
            $table->mediumText('remarks')->nullable();
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->string('ref_doc_number')->nullable();
            $table->dateTime('doc_date');
            $table->dateTime('entry_date');
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
