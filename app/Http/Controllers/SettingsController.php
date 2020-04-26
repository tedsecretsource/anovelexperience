<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function main(Request $request)
    {
        return view('settings', [
            'user' => auth()->user()
        ]);
    }
    public function password(Request $request)
    {
        return view('settings.password', [
            'user' => auth()->user()
        ]);
    }
}
