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
            $table->foreignId('novel_id')->constrained()->onDelete('cascade');
            $table->bigInteger('entry_author_id');
            $table->string('source', 255)->nullable()->comment('Ex. Jonathan Harker\'s Journal');
            $table->integer('order')->nullable();
            $table->string('title', 255)->nullable()->comment('A title for this entry - can be made up');
            $table->dateTime('entry_date')->nullable();
            $table->longText('entry')->nullable();
            $table->text('editors_note')->nullable();
            $table->string('font', 255)->nullable()->default('serif');
            $table->timestamps();
            $table->softDeletes();
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
