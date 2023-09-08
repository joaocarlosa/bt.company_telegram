<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bots', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('telegram_id')->unique();  // Identificador único do bot no Telegram
            $table->boolean('is_bot');
            $table->string('first_name');
            $table->string('username')->unique();
            $table->boolean('can_join_groups');
            $table->boolean('can_read_all_group_messages');
            $table->boolean('supports_inline_queries');
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
        Schema::dropIfExists('bots');
    }
}

