<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemReportCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_report_comments', function (Blueprint $table) {
            $table->increments('id')->comment('Auto increase ID');
            $table->integer('parent_id')->unsigned()->nullable()->comment('Refers on the same table column id');
            $table->integer('user_id')->unsigned()->comment('Refers on users table column id');
            $table->integer('report_id')->unsigned()->comment('Refers on item_reports table column id');
            $table->text('comment')->comment('Comment');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parent_id')->references('id')->on('item_report_comments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('report_id')->references('id')->on('item_reports')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('item_report_comments');
    }
}
