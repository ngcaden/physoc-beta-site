<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('set');
            $table->timestamps();
        });

        DB::table('course_notes')->insert([
            'course_id' => '1',
            'name' => 'Lecture 1',
            'set' => '2016 EM',
            'url' => '/',
        ]);
        DB::table('course_notes')->insert([
            'course_id' => '1',
            'name' => 'Lecture 2',
            'set' => '2016 EM',
            'url' => '/',
        ]);
        DB::table('course_notes')->insert([
            'course_id' => '2',
            'name' => 'Lecture 1',
            'set' => '2016 Electronics',
            'url' => '/',
        ]);
        DB::table('course_notes')->insert([
            'course_id' => '1',
            'name' => 'Lecture 1',
            'set' => '2017 EM',
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
        Schema::dropIfExists('course_notes');
    }
}
