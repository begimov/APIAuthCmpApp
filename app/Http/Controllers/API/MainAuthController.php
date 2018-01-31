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
            'scope' => 'view-messages'
        ]);

        return redirect('http://apiauthcmp.test/oauth/authorize?' . $query);
    }

    public function callback(Request $request)
    {
        $res = $this->guzzleClient->post('http://apiauthcmp.test/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '3',
                'client_secret' => 'rUJ2UWJzh3HNGsOjXHcjZVwyngZDna6nMZVjDzqb',
                'redirect_uri' => 'http://apiauthcmpapp.test/auth/main/callback',
                'code' => $request->code,
            ]
        ]);

        $res = json_decode((string) $res->getBody(), true);

        $request->user()->token()->delete();

        $request->user()->token()->create([
            'access_token' => $res['access_token']
        ]);

        return redirect('/home');
    }
}
