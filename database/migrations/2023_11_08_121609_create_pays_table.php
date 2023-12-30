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
        Schema::create('pays', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('payment_type', 255)->nullable();
            $table->decimal('amount_paid', 10, 2)->notNull();
            $table->decimal('remaining_balance', 10, 2)->notNull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pays');
    }
};
