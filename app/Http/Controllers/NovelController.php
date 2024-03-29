<?php

namespace App\Http\Controllers;

use App\Novel;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('novel.index', [
            'user' => auth()->user(),
            'novels' => \App\Novel::all()->sortBy('title')
        ]);
    }

    /**
     * Show the form for subscribing.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $novel = Novel::find($request->id);
        return view('novel.details', [
            'novel' => $novel
        ]);
    }

    /**
     * Display the settings for a novel you are subscribed to.
     *
     * @param  \App\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function settings(Request $request)
    {
        $novel = Novel::find($request->id);
        $user = auth()->user();
        if ($user->isSubscribed($novel->id)) {
            $sub = $user->subscriptions
                ->where('novel_id', $novel->id)
                ->where('status', '!=', 'canceled')
                ->where('status', '!=', 'fulfilled')
                ->first();
            if ($sub) {
                return view('novel.settings', [
                    'novel' => $novel,
                    'user' => $user,
                    'subscription' => $sub
                ]);
            }
        }
        return view('novel.details', [
            'novel' => $novel
        ]);
    }

    public function updateSettings(Request $request)
    {
        $novel = Novel::find($request->id);
        $user = auth()->user();
        if ($user->isSubscribed($novel->id)) {
            $sub = $user->subscriptions
                ->where('novel_id', $novel->id)
                ->where('status', '!=', 'canceled')
                ->where('status', '!=', 'fulfilled')
                ->first();
            if ($sub->count() > 0) {
                $sub->pace = $request->pace;
                $sub->status = $request->status ? 'paused' : 'active';
                $sub->save();
                return redirect('settings')->with('system-feedback', 'Settings updated!');
            }
        }
        return view('novel.details', [
            'novel' => $novel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function edit(Novel $novel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Novel $novel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Novel $novel)
    {
        //
    }
}
