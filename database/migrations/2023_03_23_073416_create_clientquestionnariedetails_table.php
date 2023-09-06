<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('clientquestionnariedetails')) {
            return;
        }

        Schema::create('clientquestionnariedetails', function (Blueprint $table) {
            $table->integer('id', true)->unique('clientquestionnariedetails_id_uindex');
            $table->integer('clientquestionnarie_id');
            $table->integer('questionnariedetail_id');
            $table->string('reply', 500)->nullable();
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['clientquestionnarie_id', 'questionnariedetail_id', 'id'], 'clientquestionnariedetails_cq_index');
            $table->index(['questionnariedetail_id', 'clientquestionnarie_id'], 'clientquestionnariedetails_qc_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientquestionnariedetails');
    }
};
