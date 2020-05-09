<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;
use App\Mail\StandardEntry;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show a preview of the email for the selected entry
     *
     * @return \Illuminate\Http\Response
     */
    public function previewEmail(Request $request)
    {
        $entry = Entry::find($request->id);
        return new StandardEntry(auth()->user(), $entry);
    }
}
