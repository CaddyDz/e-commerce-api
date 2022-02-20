<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->comment('UUID to allow easy migration between envs without breaking FK in the logic');
            $table->string('title');
            $table->string('content');
            $table->json('metadata')->comment('Ex: valid_from & valid_to (Y-m-d), image (uuid from files table, can grow on demand');
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
        Schema::dropIfExists('promotions');
    }
}
