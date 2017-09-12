<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('url');
            $table->text('description');
            $table->string('logo');
            $table->timestamps();
        });

        DB::table('sponsors')->insert(['name' => 'TradeTeq',
                    'url' => 'https://www.tradeteq.com',
                    'description' => "TradeTeq is a technology platform for trade finance. We create transparency and liquidity by using advanced analytics, data visualisation, and machine learning. Our technology provides deeper insights into trade finance exposures for better portfolio selection and management. At TradeTeq we believe in working together as a team to develop great products that transform trade finance. Everyone at TradeTeq is driven by excellence and innovation and we are constantly challenging the status quo.",
                    'logo' => '/images/sponsors/tradeteq.png'
                    ]);

        DB::table('sponsors')->insert(['name' => 'Pearl Diver Capital',
                    'url' => 'https://www.pearldivercapital.com',
                    'description' => "Pearl Diver Capital is a boutique asset manager, regulated and authorized by the FCA. We are specialists in securitised products, offering institutional investors access to US and Global corporate credit, in a structured format, through investments in Collateralised Loan Obligation (CLO) tranches.",
                    'logo' => '/images/sponsors/pearldivercapital.jpg'
                    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}
