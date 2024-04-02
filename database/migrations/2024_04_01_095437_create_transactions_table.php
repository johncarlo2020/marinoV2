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
            $table->string('number');
            $table->string('name');
            $table->string('baht_amount');
            $table->string('php_amount');
            $table->string('mop');
            $table->string('or');
            $table->string('notes')->nullable();
            $table->unsignedBigInteger('shift_id');
            $table->timestamps();
                
            $table->index(["shift_id"], 'shift-transaction');
        
            $table->foreign('shift_id', 'shift-transaction')
                ->references('id')->on('shifts')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        
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
