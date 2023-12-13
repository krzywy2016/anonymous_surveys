<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Przechowuje informacje o sekcjach w ankiecie
     * 
     * @property int $id Unikalny identyfikator sekcji.
     * @property int $survey_id Identyfikator ankiety, do której sekcja jest przypisana.
     * @property string $name Nazwa sekcji.
     * @property \Illuminate\Support\Carbon $created_at Data utworzenia rekordu.
     * @property \Illuminate\Support\Carbon $updated_at Data ostatniej aktualizacji rekordu.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('survey_id');
            $table->string('name');
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
        Schema::dropIfExists('sections');
    }
}
