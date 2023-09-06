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
        if (Schema::hasTable('detailtypes')) {
            return;
        }

        Schema::create('detailtypes', function (Blueprint $table) {
            $table->integer('id', true)->unique('detailtypes_id_uindex');
            $table->string('name', 100);
            $table->integer('listing')->default(0);
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailtypes');
    }
};
