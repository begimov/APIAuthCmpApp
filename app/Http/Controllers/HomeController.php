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
        $messages = collect();
    
        if (auth()->user()->token) {
            $res = $this->guzzleClient->get('http://apiauthcmp.test/api/messages', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . auth()->user()->token->access_token
                ]
            ]);
            $messages = collect(json_decode($res->getBody()));
        }

        return view('home')->with([
            'messages' => $messages,
        ]);
    }
}
