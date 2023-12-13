<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Tabela 'answers' przechowuje odpowiedzi na pytania w kontekście ankiet.
     *
     * @property int $id Unikalny identyfikator odpowiedzi.
     * @property int $survey_id Identyfikator ankiety.
     * @property int $question_id Identyfikator pytania, do którego odnosi się odpowiedź.
     * @property string|null $token Indywidualny token aby powiązać odpowiedzi niezalogowanych użytkowników. Opcjonalny ponieważ dla anonimowych mamy user_id.
     * @property int|null $user_id Identyfikator użytkownika wypełniającego ankietę. Opcjonalne, ponieważ dopuszczamy ankiety anonimowe.
     * @property string $value Wartość odpowiedzi.
     * @property \Illuminate\Support\Carbon $created_at Data utworzenia rekordu.
     * @property \Illuminate\Support\Carbon $updated_at Data ostatniej aktualizacji rekordu.
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('survey_id');
            $table->unsignedInteger('question_id');
            $table->string('token')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('value');
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
        Schema::dropIfExists('answers');
    }
}
