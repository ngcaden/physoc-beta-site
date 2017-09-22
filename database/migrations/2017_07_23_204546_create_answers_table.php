<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paper_id')->unsigned();
            $table->integer('question')->unsigned();
            $table->text('body');
            $table->timestamps();
        });

        DB::table('answers')->insert(['paper_id' => '1', 
                                      'question' => '1', 
                                      'body' => 'i. EM 2016 Test Solution']);
        DB::table('answers')->insert(['paper_id' => '2', 
                                      'question' => '2', 
                                      'body' => 'i. EM 2015 Test Solution']);
        DB::table('answers')->insert(['paper_id' => '3', 
                                      'question' => '1', 
                                      'body' => 'i. Electronics 2016 Test Solution']);
        DB::table('answers')->insert(['paper_id' => '2', 
                                      'question' => '1', 
                                      'body' => 'i. EM 2015 Test Solution']);                                      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
