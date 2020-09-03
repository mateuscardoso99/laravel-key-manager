<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_chave');
            $table->foreign('id_chave')->references('id')->on('chaves')->onDelete('cascade');

            $table->unsignedBigInteger('id_porteiro');
            $table->foreign('id_porteiro')->references('id')->on('porteiros')->onDelete('cascade');

            $table->unsignedBigInteger('id_aluno')->nullable();
            $table->foreign('id_aluno')->references('id')->on('alunos')->onDelete('cascade');

            $table->unsignedBigInteger('id_professor')->nullable();
            $table->foreign('id_professor')->references('id')->on('professors')->onDelete('cascade');

            $table->string('data_inicio');
            $table->string('data_fim')->default('em andamento');
            $table->string('status')->default('em andamento');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('aulas');
    }
}
