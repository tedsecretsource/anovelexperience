<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ConfirmedPayPalPurchase;

class SubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required|min:5|max:255'
            'payment_id' => ['exclude_if:type,trial', new ConfirmedPayPalPurchase],
            'gift_email' => 'exclude_unless:type,gift|email'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'payment_id' => 'Sorry, your payment was not successful. Please try again.',
            'gift_email' => 'Sorry but we need you to enter an email address for your gift subscription.'
        ];
    }
}
