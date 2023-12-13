<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Ta migracja tworzy tabelę przechowującą informacje o ankietach.
     * 
     * @property int $id Unikalny identyfikator ankiety.
     * @property int $user_id Identyfikator użytkownika, który utworzył ankietę.
     * @property string $title Tytuł ankiety.
     * @property string $description Opis ankiety.
     * @property string $slug Unikalny link do ankiety.
     * @property string $url_to_share Dodatkowy unikalny link do ankiety zamkniętej/niepublicznej.
     * @property string $visibility Oznaczenie widoczności ankiety, czy jest dostępna czy niedostępna.
     * @property string $state Oznaczenie widoczności ankiety, czy jest publiczna, czy prywatna.
     * @property \Illuminate\Support\Carbon $created_at Data utworzenia rekordu.
     * @property \Illuminate\Support\Carbon $updated_at Data ostatniej aktualizacji rekordu.
     */

    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->string('description');
            $table->string('slug')->unique();
            $table->string('url_to_share')->unique();
            $table->enum('state', ['published', 'unpublished'])->default('unpublished');
            $table->enum('visibility', ['public', 'private'])->default('private');
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
        Schema::dropIfExists('surveys');
    }
}
