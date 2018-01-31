<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Guzzle;

class MainAuthController extends Controller
{
    protected $guzzleClient;
    
    public function __construct(Guzzle $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function redirect()
    {
        $query = http_build_query([
            'client_id' => '3',
            'redirect_uri' => 'http://apiauthcmpapp.test/auth/main/callback',
            'response_type' => 'code',
            'scope' => '*'
        ]);

        return redirect('http://apiauthcmp.test/oauth/authorize?' . $query);
    }

    public function callback(Request $request)
    {
        var_dump($request);
    }
}
