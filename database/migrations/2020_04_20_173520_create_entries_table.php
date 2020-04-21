<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('novel_id')->nullable();
            $table->bigInteger('author_id')->nullable();
            $table->integer('order');
            $table->dateTime('entry_date')->nullable();
            $table->longText('entry')->nullable();
            $table->text('editors_note')->nullable();
            $table->string('font', 255)->nullable()->default('serif');
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
        Schema::dropIfExists('entries');
    }
}
