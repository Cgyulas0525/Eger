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
        if (Schema::hasTable('partnerquestionnaries')) {
            return;
        }

        Schema::create('partnerquestionnaries', function (Blueprint $table) {
            $table->integer('id', true)->unique('partnerquestionnarie_id_uindex');
            $table->integer('partner_id');
            $table->integer('questionnarie_id');
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['questionnarie_id', 'partner_id'], 'partnerquestionnarie_questionnarie_id_partner_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partnerquestionnaries');
    }
};
