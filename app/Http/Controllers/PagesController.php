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

    public function getPosts() {
        return view('pages.posts');
    }

    public function getSponsors() {
        return view('pages.sponsors');
    }
}