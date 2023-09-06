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
        if (Schema::hasTable('vouchers')) {
            return;
        }

        Schema::create('vouchers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 200);
            $table->integer('vouchertype_id');
            $table->integer('partner_id');
            $table->string('content', 500)->nullable();
            $table->date('validityfrom');
            $table->date('validityto')->nullable();
            $table->string('qrcode', 500);
            $table->integer('discount')->default(0);
            $table->integer('discountpercent')->default(0);
            $table->integer('usednumber')->default(0);
            $table->integer('active')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['id'], 'vouchers_id_uindex');
            $table->unique(['name', 'id'], 'vouchers_name_id_uindex');
            $table->unique(['partner_id', 'id'], 'vouchers_partner_id_id_uindex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
};
