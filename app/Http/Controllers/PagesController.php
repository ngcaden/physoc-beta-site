<?php

namespace App\Http\Controllers;

use App\Post;
use App\Sponsor;

class PagesController extends Controller {

    public function getIndex() {
        $posts = Post::orderBy('created_at', 'desc')->limit(5)->get();
        $sponsors = Sponsor::all();
        return view('pages.welcome')->withPosts($posts)->withSponsors($sponsors);
    }

    public function getAbout() {
        $first = 'Quang';
        $last = 'Nguyen';

        $fullname = $first . " " . $last;
        
        $email = 'qn14@ic.ac.uk';

        $data = [];
        $data['email'] = $email;
        $data['fullname'] = $fullname;

        return view('pages.about')->withData($data);
    }

    public function getSponsors() {
        $sponsors = Sponsor::all();
        return view('pages.sponsorship')->withSponsors($sponsors);
    }
}