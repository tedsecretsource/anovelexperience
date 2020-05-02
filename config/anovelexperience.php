<?php
return [
    'number_of_trial_chapters' => 10,
    'receiver_email' => env('PAYPAL_MERCHANT_EMAIL', 'merchant@dracula.email'),
    'paypal_token_lifetime' => 0,
    'paypal_token_refreshed' => '1970-01-01 00:00:00',
    'paypal_token' => '',
    'gift_subscription_pending_days' => 60
];
