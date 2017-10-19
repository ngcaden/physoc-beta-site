<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solutions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paper_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->string('url');
            $table->timestamps();
        });

        DB::table('solutions')->insert([
            'paper_id' => '1',
            'course_id' => '1',
            'url' => '/',
        ]);
        DB::table('solutions')->insert([
            'paper_id' => '1',
            'course_id' => '1',
            'url' => '/',
        ]);
        DB::table('solutions')->insert([
            'paper_id' => '2',
            'course_id' => '1',
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
        Schema::dropIfExists('solutions');
    }
}
