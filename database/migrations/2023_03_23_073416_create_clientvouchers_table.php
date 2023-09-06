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
        if (Schema::hasTable('clientvouchers')) {
            return;
        }

        Schema::create('clientvouchers', function (Blueprint $table) {
            $table->integer('id', true)->unique('clientvoucher_id_uindex');
            $table->integer('client_id');
            $table->integer('voucher_id');
            $table->date('posted');
            $table->integer('used')->nullable()->default(0);
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['client_id', 'voucher_id'], 'clientvoucher_client_id_voucher_id_index');
            $table->index(['used', 'client_id', 'voucher_id'], 'clientvoucher_used_client_id_voucher_id_index');
            $table->index(['used', 'voucher_id', 'client_id'], 'clientvoucher_used_voucher_id_client_id_index');
            $table->index(['voucher_id', 'client_id'], 'clientvoucher_voucher_id_client_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientvouchers');
    }
};
