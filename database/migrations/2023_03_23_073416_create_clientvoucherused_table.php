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
        if (Schema::hasTable('clientvoucherused')) {
            return;
        }

        Schema::create('clientvoucherused', function (Blueprint $table) {
            $table->integer('id', true)->index();
            $table->integer('clientvoucher_id');
            $table->timestamp('usedtime');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['clientvoucher_id', 'usedtime']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientvoucherused');
    }
};
