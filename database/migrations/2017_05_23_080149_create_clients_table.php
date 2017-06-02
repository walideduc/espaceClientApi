<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('id_mercure',15);
            $table->string('siret',14);
            $table->string('raison_sociale');
            $table->string('enseigne');
            $table->string('adress_1');
            $table->string('adress_2');
            $table->string('adress_3');
            $table->string('ville');
            $table->string('id_ref_tiers');
            $table->timestamps();
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
}
