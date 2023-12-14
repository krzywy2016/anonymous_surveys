<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Tabela questions przechowuje w sobie informacje na temat pytań
     * 
     * @property int $id Unikalny identyfikator pytania.
     * @property int $survey_id Identyfikator ankiety, do której pytanie jest przypisane.
     * @property string $content Treść pytania.
     * @property string $type Typ pytania (domyślnie 'text').
     * @property array|null $options Opcje pytania w formie JSON (opcjonalne).
     * @property array|null $rules Reguły pytania w formie JSON (opcjonalne).
     * @property int $order Kolejność pytania (domyślnie 1).
     * @property \Illuminate\Support\Carbon $created_at Data utworzenia rekordu.
     * @property \Illuminate\Support\Carbon $updated_at Data ostatniej aktualizacji rekordu.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('survey_id');
            $table->string('content');
            $table->string('type')->default('text');
            $table->json('options')->nullable();
            $table->json('rules')->nullable();
            $table->integer('order')->default(1);
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
        Schema::dropIfExists('questions');
    }
}
