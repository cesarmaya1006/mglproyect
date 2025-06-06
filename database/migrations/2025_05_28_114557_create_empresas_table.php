<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('grupo_id')->nullable();
            $table->foreign('grupo_id', 'fk_empresa_grupo')->references('id')->on('grupos')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('tipo_documento_id');
            $table->foreign('tipo_documento_id', 'fk_empresa_tipo_documentos')->references('id')->on('tipo_documentos')->onDelete('restrict')->onUpdate('restrict');
            $table->string('identificacion')->unique();
            $table->string('empresa');
            $table->string('email')->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('direccion')->nullable();
            $table->string('logo')->default('empresa1.png');
            $table->bigInteger('estado')->default(1);
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
