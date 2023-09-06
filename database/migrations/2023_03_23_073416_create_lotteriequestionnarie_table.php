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
        if (Schema::hasTable('lotteriequestionnarie')) {
            return;
        }

        Schema::create('lotteriequestionnarie', function (Blueprint $table) {
            $table->integer('id', true)->unique('lotteriequestionnarie_id_uindex');
            $table->integer('lotterie_id');
            $table->integer('questionnarie_id');
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['lotterie_id', 'questionnarie_id']);
            $table->index(['questionnarie_id', 'lotterie_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotteriequestionnarie');
    }
};
