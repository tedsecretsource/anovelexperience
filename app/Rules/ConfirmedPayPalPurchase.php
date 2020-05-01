<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ConfirmedPayPalPurchase implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $purchase = $this->get_purchase($value);
        if (is_object($purchase) and $purchase->id == $value and $purchase->status == 'COMPLETED') {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The payment was not successful. Please try again.';
    }

    /**
     * Get a valid token
     *
     * @return string
     */
    public static function get_token()
    {
        // config(['anovelexperience.paypal_token_lifetime' => 1000]);
        $refreshed = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', config('anovelexperience.paypal_token_refreshed'));
        $expires = $refreshed->addSeconds(config('anovelexperience.paypal_token_lifetime'));
        if ($expires < \Carbon\Carbon::now()) {
            // refresh the token
            $tokenObj = self::call_paypal_for_token();
            $token = $tokenObj->access_token;
            config(['anovelexperience.paypal_token_lifetime' => $tokenObj->expires_in]);
            config(['anovelexperience.paypal_token' => $tokenObj->access_token]);
            config(['anovelexperience.paypal_token_refreshed' => \Carbon\Carbon::now()->toDateTimeString()]);
        }
        return config('anovelexperience.paypal_token');
    }

    /**
     * Get a purchase
     *
     * @param string $token
     * @return object The JSON response decoded
     */
    public static function get_purchase($txn_id)
    {
        $token = self::get_token();
        $curl = curl_init();
        $paypal_domain = self::paypal_api_domain();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$paypal_domain/v2/payments/captures/$txn_id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public static function paypal_api_domain()
    {
        if ('sandbox' == env('PAYPAL_MODE')) {
            return 'https://api.sandbox.paypal.com';
        }
        return 'https://api.paypal.com';
    }

    public static function call_paypal_for_token()
    {
        $curl = curl_init();
        $b64Auth = base64_encode(env('PAYPAL_CLIENT_ID') . ':' . env('PAYPAL_SECRET'));
        $paypal_domain = self::paypal_api_domain();
        curl_setopt_array($curl, [
            CURLOPT_URL => "$paypal_domain/v1/oauth2/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic $b64Auth",
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
}
