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
        if (Schema::hasTable('questionnairedetails')) {
            return;
        }

        Schema::create('questionnairedetails', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('questionnaire_id');
            $table->string('name', 200);
            $table->integer('detailtype_id');
            $table->integer('required')->default(0);
            $table->integer('readonly')->default(0);
            $table->integer('long')->nullable();
            $table->integer('rowcount')->nullable()->default(1);
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['id'], 'questionnairedetails_id_uindex');
            $table->index(['questionnaire_id', 'id']);
            $table->index(['questionnaire_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnairedetails');
    }
};
