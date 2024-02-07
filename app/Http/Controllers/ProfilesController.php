<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    public function show()
    {
        
        $user = auth()->user();
    
        $cart = $user->cart()->first(); // Fetch the user's cart
        
        return view('profiles.index', compact('user', 'cart'));
        
    }
}
