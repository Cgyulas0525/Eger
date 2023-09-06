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
        if (Schema::hasTable('questionnairedetailitems')) {
            return;
        }

        Schema::create('questionnairedetailitems', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('questionnariedetail_id');
            $table->string('value', 200);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['id'], 'questionnairedetailitems_id_uindex');
            $table->unique(['questionnariedetail_id', 'id'], 'questionnairedetailitems_questionnariedetail_id_id_uindex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnairedetailitems');
    }
};
