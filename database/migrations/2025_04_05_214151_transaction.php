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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('numero_conta');
            $table->string('forma_pagamento');
            $table->decimal('valor', total: 8, places: 2);
            $table->decimal('taxa', total: 8, places: 2);
            $table->foreign('numero_conta')->references('numero_conta')->on('accounts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
