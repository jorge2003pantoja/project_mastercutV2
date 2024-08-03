<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('citas')) {
            Schema::create('citas', function (Blueprint $table) {
                $table->id();
                $table->string('nombre_completo');
                $table->string('numero_telefono');
                $table->string('correo_electronico');
                $table->date('fecha');
                $table->time('hora');
                $table->text('servicios');
                $table->decimal('costo', 8, 2);
                $table->foreignId('id_barbero')->constrained('barberos');
                $table->foreignId('id_usuario')->constrained('users');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
}

