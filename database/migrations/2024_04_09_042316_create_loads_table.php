<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number');
            $table->string('email');
            $table->string('mop');
            $table->string('type');

            $table->unsignedBigInteger('network_id');
            $table->unsignedBigInteger('amount_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->string('image');
            $table->string('status')->default('pending');

            $table->timestamps();

            $table->index(["network_id"], 'load-network');
        
            $table->foreign('network_id', 'load-network')
                ->references('id')->on('networks')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->index(["amount_id"], 'load-amount');
        
            $table->foreign('amount_id', 'load-amount')
                ->references('id')->on('amounts')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->index(["package_id"], 'load-package');
        
            $table->foreign('package_id', 'load-package')
                ->references('id')->on('packages')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loads');
    }
};
