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
        if (Schema::hasTable('vouchertypes')) {
            return;
        }

        Schema::create('vouchertypes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 200);
            $table->integer('local')->default(0);
            $table->integer('localfund')->default(0);
            $table->integer('localreplay')->default(0);
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['id'], 'vouchertypes_id_uindex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchertypes');
    }
};
