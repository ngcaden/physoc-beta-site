<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsefulLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('useful_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->string('name');
            $table->string('url');
            $table->timestamps();
        });
        DB::table('useful_links')->insert([
            'course_id' => '1',
            'name' => 'Electricity & Magnetism Link 1',
            'url' => '/',
        ]);
        DB::table('useful_links')->insert([
            'course_id' => '1',
            'name' => 'Electricity & Magnetism Link 2',
            'url' => '/',
        ]);
        DB::table('useful_links')->insert([
            'course_id' => '2',
            'name' => 'Electronics Link 1',
            'url' => '/',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('useful_links');
    }
}
