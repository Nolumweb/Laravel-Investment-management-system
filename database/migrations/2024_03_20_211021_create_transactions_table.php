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
                $table->bigIncrements('id');
                $table->bigInteger('user_id')->unsigned();
                $table->enum('type', ['deposit','withdrawal','transfer','credit','deduct']);
                $table->decimal('amount', 10, 2);
                $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
                $table->string('payment_proof')->nullable();
                $table->string('transaction_id', 11)->unique(); // Add transaction_id field
                $table->string('wallet_address')->nullable();
                $table->decimal('charge', 10, 2)->nullable();
                $table->text('feedback')->nullable();
                $table->string('altValue')->nullable();
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
