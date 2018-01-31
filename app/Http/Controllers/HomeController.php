<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as Guzzle;

class HomeController extends Controller
{
    protected $guzzleClient;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guzzle $guzzleClient)
    {
        $this->middleware('auth');

        $this->guzzleClient = $guzzleClient;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
