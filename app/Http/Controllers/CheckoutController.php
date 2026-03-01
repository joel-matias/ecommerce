<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index()
    {

        $access_token = $this->generateAccessToken();

        $session_token = $this->generateSessionToken($access_token);

        return view('checkout.index', compact('session_token'));
    }

    public function generateAccessToken()
    {
        $url_api = config('services.niubiz.url_api').'/api.security/v1/security';
        $user = config('services.niubiz.user');
        $password = config('services.niubiz.password');

        $auth = base64_encode($user.':'.$password);

        return Http::withHeaders([
            'Authorization' => 'Basic '.$auth,
        ])->get($url_api)->body();
    }

    public function generateSessionToken($access_token)
    {
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api')."/api.ecommerce/v2/ecommerce/token/session/{$merchant_id}";

        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json',
        ])
            ->post($url_api, [
                'channel' => 'web',
                'amount' => Cart::instance('shopping')->subtotal(),
                'antifraud' => [
                    'client_ip' => request()->ip(),
                    'merchantDefineData' => [
                        'MDD15' => 'value15',
                        'MDD20' => 'value20',
                        'MDD33' => 'value33',
                    ],
                ],
            ])
            ->json();

        return $response['sessionKey'];
    }
}
