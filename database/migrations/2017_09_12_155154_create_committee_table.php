<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommitteeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('position');
            $table->string('picture');
            $table->timestamps();
        });

        DB::table('committee')->insert(['position' => 'President', 'name' => 'Thomas Woolley', 'picture' => '/images/committee/president.jpg']);
        DB::table('committee')->insert(['position' => 'Vice President', 'name' => 'Hunain Nadeem', 'picture' => '/images/committee/vice-president.jpg']);
        DB::table('committee')->insert(['position' => 'Secretary', 'name' => 'Timothy Marley', 'picture' => '/images/committee/secretary.jpg']);
        DB::table('committee')->insert(['position' => 'Social Secretary', 'name' => 'Joseff Davies', 'picture' => '/images/committee/social-secretary.jpg']);
        DB::table('committee')->insert(['position' => 'Treasurer', 'name' => 'Shahbaz Khan', 'picture' => '/images/committee/treasurer.jpg']);
        DB::table('committee')->insert(['position' => 'Events Officer', 'name' => 'William Richards', 'picture' => '/images/committee/events-officer.jpg']);
        DB::table('committee')->insert(['position' => 'Publicity Officer', 'name' => 'Claudia Cobo', 'picture' => '/images/committee/publicity-officer.jpg']);
        DB::table('committee')->insert(['position' => 'Webmaster', 'name' => 'Quang Nguyen', 'picture' => '/images/committee/webmaster.jpg']);
        DB::table('committee')->insert(['position' => 'Education and Lecturers Officer', 'name' => 'Jemima Graham', 'picture' => '/images/committee/education-officer.jpg']);
        DB::table('committee')->insert(['position' => 'Careers and Sponsorship Officer', 'name' => 'Nicholas Lee', 'picture' => '/images/committee/sponsorship-officer.jpg' ]);  
        DB::table('committee')->insert(['position' => 'Department Representative', 'name' => 'Michaela Flegrova', 'picture' => '/images/committee/dep-rep.jpg']);
        DB::table('committee')->insert(['position' => 'PG Department Representative', 'name' => 'Lloyd James', 'picture' => '/images/committee/pg-dep-rep.jpg' ]);  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
