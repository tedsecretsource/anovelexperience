<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use App\Classes\PaypalIPN;
use App\User;

class SubscriptionController extends Controller
{
    public function paypalipn(Request $request)
    {
        \Log::info($request);
        $ipn = new PaypalIPN();
        // Use the sandbox endpoint during testing.
        if (config('app.env') !== 'production') {
            $ipn->useSandbox();
        }

        $verified = $ipn->verifyIPN();
        if ($verified) {
            /*
            * Process IPN
            * A list of variables is available here:
            * https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
            */
            // verify the amount charged, if wrong, do not subscribe the user, 'mc_gross' => 4.90 * 100 == $novel->amount
            if ($request->mc_gross * 100 <> $novel->amount) {
                return redirect()->route('novel.subscribe', [$novel])->with('system-feedback', "Sorry. Your purchase was not completed successfully. The amount paid ({$request->mc_gross}) was not equal to the amount of the subscription ($novel->amountAsCurrency)");
            }
            // make sure the payment status is success
            if ($request->payment_status != 'Completed' and $request->payment_status != 'Processed') {
                return redirect()->route('novel.subscribe', [$novel])->with('system-feedback', "Sorry. Your purchase was not completed successfully. Please try another payment method and try again or contact us for assistance.");
            }

            $type = $request->type;
            $status = $request->type == 'gift' ? 'gift' : 'full';
            $payment_date = new \Carbon\Carbon(new \DateTime($request->payment_date));
            $first_entry_date = $request->first_entry_date;
            $pace = $request->pace;
            $gift_email = $request->gift_email;
            $user_email = $request->user_email;
            $user = User::where('email', $user_email)->first();
            $user_id = $user->id;

            // if it is a gift, set up the user first
            if ('gift' == $type) {
                $giftuser = User::create([
                    'email' => $gift_email,
                    'name' => 'A gift from ' . $user->name
                ]);
                $giftuser->save();
                $user_id = $giftuser->id;
            }

            // update the transaction ID
            $subscription = Subscription::create([
                'novel_id' => $novel->id,
                'subscribed' => now(),
                'payment_confirmation_id' => $request->verify_sign,
                'payment_date' => $payment_date->toDateTimeString(),
                'user_id' => $user_id,
                'type' => $type,
                'status' => $status,
                'first_entry_date' => $first_entry_date->toDateTimeString(),
                'pace' => $pace
            ]);
            $subscription->save();
        }

        // Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
        header("HTTP/1.1 200 OK");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ('trial' == $request->type) {
            // create the new subscription
            $subscription = Subscription::create([
                'user_id' => auth()->user()->id,
                'novel_id' => $request->id,
                'subscribed' => now(),
                'type' => 'gift',
                'status' => 'active',
                'first_entry_date' => $request->first_entry_date,
                'pace' => $request->pace
            ]);
            $subscription->save();
        }
        return redirect()->route('novel.settings', [$novel])->with('system-feedback', 'Congratulations. You are now subscribed to ' . $novel->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
