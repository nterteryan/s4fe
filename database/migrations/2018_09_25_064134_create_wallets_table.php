<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wallet_id')->unsigned()->comment('Refers on users table column id');
            $table->integer('user_id')->unsigned()->comment('Refers on users table column id');
            $table->char('password', 66)->comment('User wallet password');
            $table->text('response')->nullable()->comment('Etherium response');
            $table->unique('password');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('created_date')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Created date');
            $table->dateTime('updated_date')->nullable()->comment('Updated date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
