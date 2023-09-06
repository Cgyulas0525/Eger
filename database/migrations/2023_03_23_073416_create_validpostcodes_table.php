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
        if (Schema::hasTable('validpostcodes')) {
            return;
        }

        Schema::create('validpostcodes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('settlement_id');
            $table->integer('postcode');
            $table->integer('active')->default(1);
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['id'], 'validpostcodes_id_uindex');
            $table->unique(['settlement_id', 'postcode'], 'validpostcodes_settlement_id_postcode_uindex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validpostcodes');
    }
};
