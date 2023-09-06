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
        if (Schema::hasTable('lotterieclient')) {
            return;
        }

        Schema::create('lotterieclient', function (Blueprint $table) {
            $table->integer('id', true)->unique('lotterieclient_id_uindex');
            $table->integer('lotterie_id');
            $table->integer('client_id');
            $table->string('description', 500)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('uptated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotterieclient');
    }
};
