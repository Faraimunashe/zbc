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
        Schema::create('license_prices', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // license type identifier e.g. Platinum
            $table->decimal('amount'); // e.g. 45.65
            $table->integer('period'); //number of licensed days
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
        Schema::dropIfExists('license_prices');
    }
};
