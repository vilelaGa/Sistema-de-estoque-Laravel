<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome_criador', 55);
            $table->date('data_prazo');
            $table->date('data_cumprimento')->nullable();
            $table->string('nome_usuario', 55)->nullable();
            $table->text('listagem_produtos');
            $table->enum('status', ['1', '0']);
            $table->enum('tipo', ['REMOCAO', 'INSERCAO']);
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
        Schema::dropIfExists('requisicoes');
    }
}
