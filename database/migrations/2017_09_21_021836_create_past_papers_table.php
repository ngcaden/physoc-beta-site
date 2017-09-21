<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('past_papers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->string('year');
            $table->string('url');
            $table->timestamps();
        });

        DB::table('past_papers')->insert([
            'course_id' => '1',
            'year' => '2016',
            'url' => '/',
        ]);

        DB::table('past_papers')->insert([
            'course_id' => '1',
            'year' => '2015',
            'url' => '/',
        ]);

        DB::table('past_papers')->insert([
            'course_id' => '2',
            'year' => '2016',
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
        Schema::dropIfExists('past_papers');
    }
}
