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
        if (Schema::hasTable('partnercontacts')) {
            return;
        }

        Schema::create('partnercontacts', function (Blueprint $table) {
            $table->integer('id', true)->unique('partnercontacts_id_uindex');
            $table->integer('partner_id');
            $table->string('name', 100);
            $table->string('password', 200);
            $table->string('email', 100);
            $table->string('phonenumber', 25)->nullable();
            $table->integer('active')->default(0);
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['active', 'id'], 'partnercontacts_active_id_uindex');
            $table->unique(['partner_id', 'id'], 'partnercontacts_partner_id_id_uindex');
            $table->unique(['partner_id', 'name', 'id'], 'partnercontacts_partner_id_name_id_uindex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partnercontacts');
    }
};
