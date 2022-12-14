<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_films', function (Blueprint $table) {
            $table->id();

            $table->unsignedBiginteger('categories_id')->unsigned();
            $table->unsignedBiginteger('films_id')->unsigned();

            $table->foreign('categories_id')->references('id')
                ->on('categories')->onDelete('cascade');
            $table->foreign('films_id')->references('id')
                ->on('films')->onDelete('cascade');

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
        Schema::dropIfExists('categories_films');
    }
}
