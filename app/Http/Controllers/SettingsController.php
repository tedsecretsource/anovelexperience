<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function password(Request $request)
    {
        return view('settings.password', [
            'user' => auth()->user()
        ]);
    }
}
