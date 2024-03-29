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
            $table->integer('amount')->default(490);
            $table->string('author', 255);
            $table->date('published')->nullable();
            $table->dateTime('first_entry_date')->default('1000-01-01 00:00:00')
                ->comment('The date and time of the first entry');
            $table->dateTime('last_entry_date')->default('1000-01-01 00:00:00')
                ->comment('The date and time of the last entry');
            $table->text('summary')->comment('Summary of the novel')
                ->nullable();
            $table->integer('subscriptions')->default(0)->nullable()
                ->comment('The total number of times someone has subscribed to this novel');
            $table->string('novel_emoji', 100)->nullable();
            $table->string('send_order')->default('date')->nullable()->comment('What order should entries be sent in, date or order?');
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
        Schema::dropIfExists('novels');
    }
}
