<?php

use Doctrine\DBAL\Schema\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('novel_id');
            $table->dateTime('subscribed')->useCurrent();
            $table->string('type', 50);
            $table->string('status', 50);
            $table->string('payment_confirmation_id')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->integer('payment_amount')->nullable();
            $table->string('payment_status')->nullable();
            $table->dateTime('first_entry_date')->nullable();
            $table->float('pace', 3, 2)->default(1.00);
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
        Schema::dropIfExists('subscriptions');
    }
}
