<?php

use Sinergi\BrowserDetector\Os;
use Sinergi\BrowserDetector\Browser;

return [

    /*
    |--------------------------------------------------------------------------
    | Browser Requirement
    |--------------------------------------------------------------------------
    |
    | Minimum Version of Supported Browsers.
    | The following array is a good start point how
    | to build your Browser Requirement.
    */
    'requirement' => [
        // OS X
        Os::OSX => [
            Browser::CHROME => 25,
            Browser::FIREFOX => 25,
            Browser::OPERA => 29,
        ],
        // Linux
        Os::LINUX => [
            Browser::CHROME => 25,
            Browser::FIREFOX => 25,
            Browser::OPERA => 29,
        ],
        // Windows
        Os::WINDOWS => [
            Browser::CHROME => 25,
            Browser::FIREFOX => 25,
            Browser::OPERA => 29,
            Browser::SAFARI => 8,
            Browser::IE => 9,
            Browser::EDGE => 11,
        ],
        // iOS
        Os::IOS => [
            //
        ],
        // Android
        Os::ANDROID => [
            //
        ],
        // Windows Phone
        Os::WINDOWS_PHONE => [
            //
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Redirect Route on Unsupported Browser.
    |--------------------------------------------------------------------------
    |
    | Create a Route like the follow example.
    | Route::get("PATH", "Controller@method")->name('requirement::browser');
    */
    'routeUnsupportedBrowser' => 'requirement::browser',

    /*
    |--------------------------------------------------------------------------
    | Redirect Route on Supported Browser.
    |--------------------------------------------------------------------------
    |
    | Redirect if supported version of browser want to visit
    | the routeUnsupportedBrowser.
    |
    | Create a Route like the follow example.
    | Route::get("/", "PagesController@index")->name('home');
    */
    'routeSupportedBrowser' => 'home',
    
];
