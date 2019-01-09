<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignupPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signup_phones', function (Blueprint $table) {
            $table->increments('id')->comment('Auto increase ID');
            $table->tinyInteger('verified')->unsigned()->comment('Verified or not');
            $table->char('hash',13)->comment('Hash for verification');
            $table->string('phone', 150)->comment('User phone');
            $table->unique('phone');
            $table->unique('hash');
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
        Schema::dropIfExists('signup_phones');
    }
}
