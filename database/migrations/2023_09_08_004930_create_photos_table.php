<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            
            
            $table->id();
            $table->string('file_unique_id')->default(''); // Valor padrão            
            $table->bigInteger('message_id');
            $table->string('file_id')->unique();
            $table->integer('file_size');
            $table->integer('width');
            $table->integer('height');
            $table->string('file_path')->nullable();
            $table->string('local_path')->nullable(); // para armazenar o caminho local da imagem, se você baixá-la
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
        Schema::dropIfExists('photos');
    }
}
