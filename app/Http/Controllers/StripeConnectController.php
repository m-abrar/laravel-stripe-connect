<?php

// app/Http/Controllers/StripeConnectController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\OAuth;

class StripeConnectController extends Controller
{
    public function redirectToStripe()
    {
        $url = 'https://connect.stripe.com/oauth/authorize?' . http_build_query([
            'response_type' => 'code',
            'client_id' => env('STRIPE_CLIENT_ID'),
            'scope' => 'read_write',
            'redirect_uri' => route('stripe.callback'),
        ]);

        return redirect($url);
    }

    public function handleCallback(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $response = OAuth::token([
            'grant_type' => 'authorization_code',
            'code' => $request->code,
        ]);

        // Save $response->stripe_user_id to your DB
        return 'Connected Account ID: ' . $response->stripe_user_id;
    }
}
