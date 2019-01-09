<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id')->comment('Auto increase ID');
            $table->integer('user_id')->unsigned()->comment('Refers on users table column id');
            $table->integer('category_id')->unsigned()->comment('Refers on item_categories table column id');
            $table->integer('status_id')->nullable()->unsigned()->comment('Refers on item_statuses table column id');
            $table->integer('transfer_ownership')->nullable()->unsigned()->comment('User transferring ownership.Refers on users table column id');
            $table->double('reward', 15, 8)->nullable()->unsigned()->comment('Reward in local currency(S4FE or in Eterium)');
            $table->string('title', 150)->comment('Item title');
            $table->text('description')->comment('Item description');
            $table->string('serial_number', 150)->comment('Item serial number');
            $table->unique('serial_number');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transfer_ownership')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('item_statuses')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('items');
    }
}
