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
        if (Schema::hasTable('clients')) {
            return;
        }

        Schema::create('clients', function (Blueprint $table) {
            $table->integer('id', true)->unique('clients_id_uindex');
            $table->string('name', 100);
            $table->string('email', 100)->index();
            $table->string('phonenumber', 25)->nullable();
            $table->date('birthday');
            $table->string('password', 191)->index();
            $table->integer('postcode');
            $table->integer('settlement_id');
            $table->string('address', 200);
            $table->string('addresscardnumber', 20)->nullable();
            $table->string('addresscardurl', 100)->nullable();
            $table->integer('validated')->default(0);
            $table->integer('active')->default(1);
            $table->integer('local')->default(0);
            $table->string('description', 500)->nullable();
            $table->integer('gender')->nullable();
            $table->string('facebookid', 50)->nullable();
            $table->string('facebookname', 200)->nullable();
            $table->string('facebookemail', 200)->nullable();
            $table->string('gmailid', 50)->nullable();
            $table->string('gmailname', 200)->nullable();
            $table->string('gmailemail', 200)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['active', 'id'], 'clients_activ_id_index');
            $table->index(['birthday', 'id']);
            $table->index(['name', 'id']);
            $table->index(['postcode', 'settlement_id', 'address']);
            $table->index(['validated', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
