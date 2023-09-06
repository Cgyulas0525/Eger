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
        if (Schema::hasTable('logitems')) {
            return;
        }

        Schema::create('logitems', function (Blueprint $table) {
            $table->integer('id', true)->unique('logitem_id_uindex');
            $table->integer('logitemtype_id');
            $table->integer('client_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('partnercontact_id')->nullable();
            $table->string('datatable', 100)->nullable();
            $table->integer('record')->nullable();
            $table->timestamp('eventdatetime')->index('logitem__eventdatetime_index');
            $table->string('remoteaddress', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['client_id', 'user_id', 'eventdatetime'], 'logitem__customeruser_index');
            $table->index(['user_id', 'eventdatetime'], 'logitem__user_index');
            $table->index(['datatable', 'eventdatetime'], 'logitem_datatable_eventdatetime_index');
            $table->index(['logitemtype_id', 'id'], 'logitem_logitemtype_id_id_index');
            $table->index(['partnercontact_id', 'eventdatetime'], 'logitem_partnercontact_id_eventdatetime_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logitems');
    }
};
