<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_contract');
            $table->decimal("payments",13,2);
            $table->decimal("withdrawals",13,2);
            $table->decimal("change",13,2);
            $table->decimal("balance",13,2);
            $table->decimal("balance_total",13,2);
            $table->decimal("renta_variable",13,2);
            $table->decimal("deuda",13,2);
            $table->unsignedInteger('id_status_balance');
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
        Schema::dropIfExists('balances');
    }
}
