<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->comment('UUID to allow easy migration between envs without breaking FK in the logic');
            $table->enum('type', [
                'credit_card',
                'cash_on_delivery',
                'bank_transfer',
            ]);
            // Stripe: Am I a joke to you
            $table->json('details')->comment('Structure depends on the payment tyoe');
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
        Schema::dropIfExists('payments');
    }
}
