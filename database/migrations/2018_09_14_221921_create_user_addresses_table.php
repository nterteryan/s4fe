<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('Refers on users table column id');
            $table->integer('country_id')->unsigned()->comment('Refers to the countries table on the id column');
            $table->integer('state_id')->unsigned()->nullable()->comment('A foreign key pointing to the states table');
            $table->integer('city_id')->unsigned()->comment(' A foreign key pointing to the cities table');
            $table->string('address1')->comment('The first line of an address.');
            $table->string('address2')->nullable()->comment('An optional second line of an address.');
            $table->string('district')->nullable()->comment('The region of an address, this may be a state, province, prefecture, etc.');
            $table->string('location',1024)->nullable()->comment('The region of an address, this may be a state, province, prefecture, etc.');
            $table->char('zip_code',5)->nullable()->comment('Zip code');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('user_addresses');
    }
}
