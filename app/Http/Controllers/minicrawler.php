<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Crawler\Crawler as Crawler;

class minicrawler extends Controller
{


    public function index()
    {
        $baseUrl='http://www.sigmalive.com/news/local';
        $crawlLogger=new Crawler($baseUrl) ;
        $a=$crawlLogger->startCrawling($baseUrl);
        dd($a);
    }

}
