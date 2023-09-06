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
        if (Schema::hasTable('questionnaires')) {
            return;
        }

        Schema::create('questionnaires', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 200);
            $table->date('validityfrom');
            $table->date('validityto')->nullable();
            $table->integer('active')->default(0);
            $table->integer('basicpackage')->nullable()->default(0);
            $table->string('qrcode', 500);
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['active', 'id'], 'questionnaires_active_id_uindex');
            $table->unique(['id'], 'questionnaires_id_uindex');
            $table->unique(['name', 'id'], 'questionnaires_name_id_uindex');
            $table->index(['validityfrom', 'validityto', 'id'], 'questionnaires_validityfrom_validitato_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnaires');
    }
};
