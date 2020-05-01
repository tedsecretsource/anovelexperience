<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use App\Classes\PaypalIPN;
use App\User;
use App\Novel;

class SubscriptionController extends Controller
{
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
    public function create(Request $request)
    {
        $user = auth()->user();
        $novel = Novel::find($request->id);
        if ($user->isSubscribed($novel->id)) {
            return redirect()->route('novel.settings', [$novel])->with('system-feedback', 'You are already subscribed to this novel');
        }
        // display subscription form
        return view('subscription_form', [
            'user' => auth()->user(),
            'novel' => Novel::find($request->id)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\SubscriptionRequest $request)
    {
        $novel = Novel::find($request->id);
        if (auth()->user()->isSubscribed($novel->id)) {
            return redirect()->route('novel.settings', [$novel])->with('system-feedback', 'You are already subscribed to this novel');
        }
        $user_id = auth()->user()->id;
        $who = 'You are';
        switch ($request->type) {
            case 'gift':
                $type = 'gift';
                $user_id = \App\User::firstOrCreate(
                    ['email' => $request->gift_email],
                    [
                        'name' => 'Gift from ' . auth()->user()->name,
                        'password' => \Hash::make(\App\User::all()->count())
                    ]
                )->id;
                $who = $request->gift_email . ' is';
                break;

            case 'full':
                $type = 'full';
                break;

            default:
                $type = 'trial';
                break;
        }

        $subscription = Subscription::create([
            'user_id' => $user_id,
            'novel_id' => $request->id,
            'subscribed' => now(),
            'type' => $type,
            'status' => 'active',
            'first_entry_date' => $request->first_entry_date,
            'pace' => $request->pace,
            'payment_confirmation_id' => $request->payment_id,
            'payment_date' => \Carbon\Carbon::now()->toDateTimeString(),
            'payment_amount' => $request->amount,
            'payment_status' => 'active'
        ]);
        $subscription->save();
        // notify gift user via email of the situation
        activity()
            ->performedOn($subscription)
            ->causedBy(auth()->user()->id)
            ->withProperties([
                'payment_id' => $request->payment_id,
                'novel_id' => $novel->id,
                'title' => $novel->title,
                'type' => $type,
                'for user_id' => $user_id
            ])
            ->log('New subscription for ' . $novel->title);
        return redirect()->route('novel.settings', [$novel])->with('system-feedback', 'Congratulations. ' . $who . ' now subscribed to ' . $novel->title);
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
