<?php

namespace App\Http\Controllers;


class PagesController extends Controller {

    public function getIndex() {
        return view('pages.welcome');
    }

    public function getAbout() {
        return view('pages.about');
    }

    public function getSponsorship() {
        return view('pages.sponsorship');
    }

    public function getManageEvents() {
        return view('pages.events');
    }

    public function getSponsors() {
        return view('pages.sponsors');
    }

    public function getWiki() {
        return view('pages.wiki');
    }
}