<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('acc_id');
            $table->string('reference'); //license number
            $table->decimal('amount');
            $table->decimal('penalt_amount');
            $table->integer('period'); //number of licensed days
            $table->date('valid_until'); //expiry date
            $table->integer('status')->default(1); // 0 => expired, 1 => valid
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
        Schema::dropIfExists('licenses');
    }
};
