<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_reports', function (Blueprint $table) {
            $table->increments('id')->comment('Auto increase ID');
            $table->integer('user_id')->unsigned()->comment('Refers on users table column id');
            $table->integer('item_id')->unsigned()->comment('Refers on items table column id');
            $table->integer('status_id')->unsigned()->comment('Refers on items_reports_statuses table column id');
            $table->unique(['user_id', 'item_id']);
            $table->text('text')->nullable()->comment('Report text');
            $table->string('name',  255)->nullable()->comment('User name who found the item');
            $table->string('email', 255)->nullable()->comment('User email who found the item');
            $table->string('address', 1024)->nullable()->comment('User address who found the item');
            $table->string('website', 1024)->nullable()->comment('The URL where the item was found');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('item_report_statuses')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('item_reports');
    }
}
