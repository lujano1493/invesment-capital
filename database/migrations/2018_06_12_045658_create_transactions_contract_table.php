<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_contract', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_contract');
            $table->smallInteger("id_type_transaction");
            $table->smallInteger("id_status_transaction");
            $table->decimal("amount",13,4);
            $table->smallInteger("id_origin");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions_contract');
    }
}
