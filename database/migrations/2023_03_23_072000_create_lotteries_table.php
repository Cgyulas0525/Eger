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
        if (Schema::hasTable('lotteries')) {
            return;
        }

        Schema::create('lotteries', function (Blueprint $table) {
            $table->integer('id', true)->unique('lotteries_id_uindex');
            $table->string('name', 200)->index();
            $table->date('lotteriedate');
            $table->string('content', 500)->nullable();
            $table->string('description', 500)->nullable();
            $table->integer('active')->default(0);
            $table->date('validityfrom');
            $table->date('validityto')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['lotteriedate', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotteries');
    }
};
