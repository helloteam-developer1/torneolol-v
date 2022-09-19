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
        Schema::create('codigoregistro', function (Blueprint $table) {
            $table->bigIncrements('idCodigo');
            $table->string('cupon');
            $table->date('fechaEvento');
            $table->string('horaEvento');
            $table->string('lugarEvento');
            $table->string('direccionEvento');
            $table->boolean('estatus');
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
        Schema::dropIfExists('codigoverificacion');
    }
};
