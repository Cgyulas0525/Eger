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
        if (Schema::hasTable('questionnarievouchers')) {
            return;
        }

        Schema::create('questionnarievouchers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('questionnarie_id');
            $table->integer('voucher_id');
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['id'], 'questionnarievoucher_id_uindex');
            $table->unique(['questionnarie_id', 'voucher_id'], 'questionnarievoucher_questionnarie_id_voucher_id_uindex');
            $table->unique(['voucher_id', 'questionnarie_id'], 'questionnarievoucher_voucher_id_questionnarie_id_uindex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnarievouchers');
    }
};
