<?php
/*
 * Imperial Auth Extension
 */
Auth::extend('imperialcollege', function() {
    $userProvider = new ImperialCollegeUserProvider(Config::get('auth.model'));
    return new Illuminate\Auth\Guard($userProvider, App::make('session'));
});