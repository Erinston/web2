<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFraseGeneroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frase_genero', function (Blueprint $table) {
            $table->foreignId('frase_id')->constrained()->onDelete('cascade');
            $table->foreignId('genero_id')->constrained()->onDelete('cascade');
            $table->unique(['frase_id','genero_id']);
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
        Schema::dropIfExists('frase_genero');
    }
}
