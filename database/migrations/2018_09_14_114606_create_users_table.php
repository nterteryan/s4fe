<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('Auto increase ID');
            $table->char('uuid',36)->comment('User UUID');
            
            $table->integer('type_id')  ->unsigned()             ->comment('Refers to the column id of the table user_types');
            $table->integer('status_id')->unsigned()             ->comment('Refers to the column title of the table user_statuses');
            $table->tinyInteger('item_report_banned')->unsigned()->comment('Shows that the user has the right to react to the items.0 => not banned,1=>banned');
            
            $table->string('first_name',32)->nullable()                      ->comment('User first name');
            $table->string('last_name',32)   ->nullable()                    ->comment('User last name');
            $table->string('middle_name',50) ->nullable()        ->comment('User middle name');
            $table->string('display_name',65)->nullable()        ->comment('The name that the user wants to display, like nickname');
            $table->string('nationality', 150) ->nullable()                  ->comment('User Nationality');
            $table->string('phone', 150)->nullable()             ->comment('User phone');
            $table->string('photo', 150)->nullable()             ->comment('User photo(avatar)');
            $table->enum('gender', ['male', 'female'])->default('male')->comment('Specifies the user\'s gender');
            $table->date('birth_date')    ->nullable()                       ->comment('User birth date');
            $table->char('remember_token', 100)->nullable()      ->comment('Will be used to store the "remember me" token');

            $table->string('email', 150)                         ->comment('User email');
            $table->string('password', 100)                      ->comment('User password');

            $table->unique('uuid');
            $table->unique('email');
            $table->unique('phone');
            $table->unique('photo');

            $table->foreign('type_id')->references('id')->on('user_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('user_statuses')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('users');
    }
}
