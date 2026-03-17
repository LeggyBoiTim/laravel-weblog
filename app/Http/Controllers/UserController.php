<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Updates the user's premium status to true.
     */
    public function upgradeToPremium()
    {
        Auth::user()->update(['has_premium' => true]);
        return redirect()->back();
    }
}
