<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('year')->unsigned();
            $table->timestamps();
        });

        DB::table('courses')->insert(['name' => 'Electricity & Magnetism','year' => '1','description' => 'EM Test']);
        DB::table('courses')->insert(['name' => 'Electronics','year' => '1']);
        DB::table('courses')->insert(['name' => 'Astrophysics','year' => '0']);
        DB::table('courses')->insert(['name' => 'Atomic & Molecular Physics','year' => '3']);
        DB::table('courses')->insert(['name' => 'Solid State','year' => '2']);
        DB::table('courses')->insert(['name' => 'Quantum Mechanics','year' => '2']);
        DB::table('courses')->insert(['name' => 'Statistical Physics','year' => '2']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
