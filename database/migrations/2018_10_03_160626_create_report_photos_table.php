<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_photos', function (Blueprint $table) {
            $table->increments('id')->comment('Auto increase ID');
            $table->integer('report_id')->unsigned()->comment('Refers on items table column id');
            $table->string('file',150)->comment('File unique name');
            $table->string('name',150)->comment('File original name');
            $table->unique('file');
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
        Schema::dropIfExists('report_photos');
    }
}
