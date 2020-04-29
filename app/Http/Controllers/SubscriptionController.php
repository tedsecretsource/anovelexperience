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
        $ipn->usePHPCerts();

        $verified = $ipn->verifyIPN($request);
        if ($verified) {
            $custom = $request->custom;
            \Log::info($custom);
            // $type = $request->type;
            // $status = $request->type == 'gift' ? 'gift' : 'full';
            // $payment_date = new \Carbon\Carbon(new \DateTime($request->payment_date));
            // $first_entry_date = $request->first_entry_date;
            // $pace = $request->pace;
            // $gift_email = $request->gift_email;
            // $user_email = $request->user_email;
            // $user = User::where('email', $user_email)->first();
            // $user_id = $user->id;

            /*
            * Process IPN
            * A list of variables is available here:
            * https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
            */
            /*
            Verify that you are the intended recipient of the IPN message. To do this, check the email address in the message. This check prevents another merchant from accidentally or intentionally using your listener.
            */
            if ($request->receiver_email != config('anovelexperience.receiver_email')) {
                activity()
                    ->withProperties(['receiver_email' => $request->receiver_email])
                    ->log('Receiver email did not match');
                abort(400);
            }
            /*
            Verify that the IPN is not a duplicate. To do this, save the transaction ID and last payment status in each IPN message in a database and verify that the current IPN's values for these fields are not already in this database.
            Note: You can't rely on transaction ID alone to screen out duplicates, as this scenario shows: 1) PayPal sends you an IPN notifying you of a pending payment. 2) PayPal later sends you a second IPN telling you that the payment has completed. However, both IPNs contain the same transaction ID; therefore, if you were using just transaction ID to identify IPNs, you would to treat the "completed payment" IPN as a duplicate.
            */
            $sub = App\Subscription::where('payment_confirmation_id', $request->txn_id)
                ->where('payment_status', 'LIKE', 'Completed');
            if ($sub->count() > 0) {
                activity()
                    ->withProperties(['txn_id' => $request->txn_id, 'payment_status' => 'Completed'])
                    ->log('Duplicate IPN Notification');
                header("HTTP/1.1 200 OK");
            }
            /*
            Ensure that you receive an IPN whose payment status is "completed" before shipping merchandise or enabling download of digital goods. Because IPN messages can be sent at various stages in a transaction's progress, you must wait for the IPN whose status is "completed' before handing over merchandise to a customer.
            */
            if (strtolower($request->payment_status) != 'completed') {
                activity()
                    ->withProperties(['payment_status' => $request->payment_status])
                    ->log('Payment has not completed');
                abort(400);
            }
            /*
            Verify that the payment amount in an IPN matches the price you intend to charge. If you do not encrypt your button code, it's possible for someone to capture a button-click message and change the price it contains. If you don't check the price in an IPN against the real price, you could accept a lower payment than you want.
            */
            if ($request->mc_gross * 100 <> $novel->amount) {
                activity()
                    ->withProperties(['payment_status' => $request->payment_status])
                    ->log('Payment has not completed');
                abort(400);
            }

            // if it is a gift, set up the user first
            // if ('gift' == $type) {
            //     $giftuser = User::create([
            //         'email' => $gift_email,
            //         'name' => 'A gift from ' . $user->name
            //     ]);
            //     $giftuser->save();
            //     $user_id = $giftuser->id;
            // }

            // update the transaction ID
            // $subscription = Subscription::create([
            //     'novel_id' => $novel->id,
            //     'subscribed' => now(),
            //     'payment_confirmation_id' => $request->verify_sign,
            //     'payment_date' => $payment_date->toDateTimeString(),
            //     'user_id' => $user_id,
            //     'type' => $type,
            //     'status' => $status,
            //     'first_entry_date' => $first_entry_date->toDateTimeString(),
            //     'pace' => $pace
            // ]);
            // $subscription->save();
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
