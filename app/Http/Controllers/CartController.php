<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;


class CartController extends Controller
{
    public function index()
{
    $cart = session()->get('cart', []);
    return view('cart.index', compact('cart'));
}

public function store(Request $request, $postId)
{
    $post = Post::findOrFail($postId); // Ensure the post exists
    $cart = session()->get('cart', []); // Retrieve the cart from session, or initialize a new one

    // Assuming $post->image contains just the $imagePath part and images are saved in a directory within public/storage
    $imageUrl = asset("storage/{$post->image}"); // Use asset helper to get the URL for the image

    if (isset($cart[$postId])) {
        if ($cart[$postId]['quantity'] < $post->amount) {
            $cart[$postId]['quantity']++;
        } else {
            return redirect()->back()->with('error', 'Cannot add more of this item.');
        }
    } else {
        // Add the post to the cart with initial details
        $cart[$postId] = [
            "title" => $post->title,
            "quantity" => 1,
            "price" => $post->price,
            "image" => $post->image // Directly use the image path as stored
        ];
    }

    session()->put('cart', $cart); // Update the session with the new cart

    return redirect()->route('cart.index')->with('success', 'Product updated in cart successfully.');
}

public function remove($postId)
{
    $cart = session()->get('cart', []);

    // Check if the post is in the cart and has more than one quantity
    if (isset($cart[$postId])) {
        if ($cart[$postId]['quantity'] > 1) {
            // Decrement the quantity
            $cart[$postId]['quantity']--;
        } else {
            // Remove the item entirely if quantity is 1
            unset($cart[$postId]);
        }

        session()->put('cart', $cart); // Update the cart in the session
        return redirect()->route('cart.index')->with('success', 'One unit of the product removed from cart successfully.');
    }

    return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
}

public function confirmPurchase(Request $request)
{
    $cart = session()->get('cart', []);
    $userId = Auth::id(); // Assuming you're tracking which user is making the purchase
    
    // Serialize the cart data
    $cartHistoryData = json_encode($cart);
    
    // Find or create a Cart record for the user
    $userCart = Cart::firstOrCreate(
        ['user_id' => $userId], // Assuming your Cart model has a 'user_id' field to link to the User model
        ['history' => '[]'] // Initialize an empty history if creating a new cart
    );

    $userCart->history = $cartHistoryData;
    $userCart->save();

    session()->forget('cart');

    return redirect()->route('cart.index')->with('success', 'Your purchase has been confirmed. Thank you!');
}

}
