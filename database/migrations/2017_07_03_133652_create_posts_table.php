<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->date('date');
            $table->string('start');
            $table->string('end');
            $table->string('location');
            $table->text('body')->nullable();
            $table->string('link')->nullable();
            $table->integer('category_id')->unsigned();
            $table->timestamps();
        });

        DB::table('posts')->insert(array(
            'title' => 'Meet Physoc',
            'date' => '2016-10-05',
            'start' => '10:00',
            'end' => '12:00',
            'location' => 'Blackett',
            'body' => "Meet the PhySoc committee, chat with coursemates, enjoy free pizza and snacks and find out what PhySoc's all about! The whole committee will be there to answer any questions and just have a general chit chat about whatever tickles your fancy. We'll then be heading to sports night after - be sure to join us!",
            'category_id' => '2'
        ));
        
        DB::table('posts')->insert(array(
            'title' => 'Pub Golf',
            'date' => '2016-10-14',
            'start' => '19:00',
            'end' => '21:00',
            'location' => 'The Union',
            'body' => "Polish your woods, get your irons out of the garage and borrow some tees off your grandad - it's game time! Join PhySoc for a night out in South Kensington! Freshers: this is a great opportunity to get to know your coursemates, other year groups and the PhySoc committee. We can't wait to meet you all!",
            'category_id' => '2'
        ));

        DB::table('posts')->insert(array(
            'title' => 'UCL-ICL do Science Museum Lates',
            'date' => '2016-10-26',
            'start' => '17:30',
            'end' => '22:00',
            'location' => 'Science Museum',
            'body' => "UCL-Imperial joint social time! Meet at the Imperial College Union at 17:30 for a few warm up pints, then we'll head down to the Science Museum! It's a 5 minute stroll to get there and entry is free (Lates run from 18:30 - 22:00).",
            'category_id' => '2'
        ));

        DB::table('posts')->insert(array(
            'title' => 'Research Frontiers: Quantum Optics & Laser Science Group',
            'date' => '2016-10-20',
            'start' => '17:00',
            'end' => '18:00',
            'location' => 'Blackett LT1',
            'body' => "Talk title: A single atomic particle at rest: the physics of creating, cooling and studying particles in an ion trap. The first Research Frontiers talk of the year given by Richard Thompson from the QOLS (Quantum Optics and Laser Science) group.",
            'category_id' => '3'
        ));
       
        DB::table('posts')->insert(array(
            'title' => 'NPL Trip',
            'date' => '2016-02-15',
            'start' => '12:00',
            'end' => '18:00',
            'location' => 'Teddington',
            'body' => "PhySoc will be visiting the National Physical Laboratory (NPL) in Teddington, Richmond Upon Thames. We will be treated to an introductory talk, followed by tours of four of the labs at NPL, and finally the opportunity for a chat with postgrads working there. This trip is absolutely free, but places are limited. Tickets will be at noon on Wednesday 9th February. We'll be meeting at the Blackett foyer (level 2) to travel as a group, or you can make your way there yourself using TfL's resources (just make sure to get there by 13:30).",
            'category_id' => '4'
        ));

        DB::table('posts')->insert(array(
            'title' => 'BP Careers Talk',
            'date' => '2016-10-13',
            'start' => '13:00',
            'end' => '14:00',
            'location' => 'Room 509',
            'body' => "Light refreshments will be provided after the talk. Registration is not required, however please indicate interest on this event so that we can cater for refreshments accordingly.",
            'category_id' => '1'
        ));
       
        DB::table('posts')->insert(array(
            'title' => "Fresher's Fair 2017",
            'date' => '2017-10-03',
            'start' => '09:00',
            'end' => '15:00',
            'location' => "Queen's Lawn",
            'body' => "Opportunity to check out all clubs and societies at Imperial College.",
            'category_id' => '1'
        ));
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
