<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novels', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('author', 255);
            $table->date('published')->nullable();
            $table->dateTime('first_entry_date')
                ->comment('The date and time of the first entry');
            $table->text('summary')->comment('Summary of the novel')
                ->nullable();
            $table->integer('subscriptions')->default(0)
                ->comment('The total number of times someone has subscribed to this novel');
            $table->string('novel_emoji', 100)->default('🧛')->nullable();
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
        Schema::dropIfExists('novels');
    }
}
