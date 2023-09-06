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
        if (Schema::hasTable('clientquestionnaries')) {
            return;
        }

        Schema::create('clientquestionnaries', function (Blueprint $table) {
            $table->integer('id', true)->unique('clientquestionnarie_id_uindex');
            $table->integer('client_id');
            $table->integer('questionnarie_id');
            $table->date('posted');
            $table->date('retrieved')->nullable();
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['client_id', 'questionnarie_id'], 'clientquestionnarie_client_id_questionnarie_id_uindex');
            $table->index(['questionnarie_id', 'client_id'], 'clientquestionnarie_questionnarie_id_client_id_index');
            $table->index(['retrieved', 'id'], 'clientquestionnarie_retrieved_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientquestionnaries');
    }
};
