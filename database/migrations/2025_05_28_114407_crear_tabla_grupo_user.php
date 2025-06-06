<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('grupo_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'fk_users_grupo')->references('id')->on('users')->onDelete('cascade')->onUpdate('restrict');
            $table->unsignedBigInteger('grupo_id');
            $table->foreign('grupo_id', 'fk_grupo_users')->references('id')->on('grupos')->onDelete('cascade')->onUpdate('restrict');
            $table->unique(['user_id','grupo_id'],'cmr_unico');
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
        Schema::dropIfExists('grupo_user');
    }
    /**
     * Run the migrations.
     */

};
