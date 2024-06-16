<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class CartController extends Controller
{
    public function showCart()
    {
        // Retrieve cart data from session
        $cart = collect(session('cart', []));

        return view('cart.show', compact('cart'));
    }

    public function removeFromCart(Request $request, $ticketId)
    {
        // Retrieve the cart from the session
        $cart = collect(session('cart', []));

        // Find the index of the ticket to be removed
        $ticketIndex = $cart->search(function ($ticket) use ($ticketId) {
            return $ticket->id == $ticketId;
        });

        // If the ticket exists in the cart, remove it
        if ($ticketIndex !== false) {
            $cart->forget($ticketIndex);
            $request->session()->put('cart', $cart->values()->all()); // Reindex the array keys after removal
            $alertType = 'success';
            $htmlMessage = "Ticket has been removed from your cart!";
        } else {
            // Set error message
            $alertType = 'error';
            $htmlMessage = 'Ticket not found in the cart.';
        }

        // Redirect to cart page with a message
        return redirect()->route('cart.show')->with('alert-msg', $htmlMessage)->with('alert-type', $alertType);
    }

    public function checkout(Request $request)
    {
        // Logic for checkout here (can include payment processing, order creation, etc.)

        // Clear the cart after checkout
        $request->session()->forget('cart');

        return redirect()->route('home')->with('success', 'Purchase completed successfully!');
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('cart'); // Remove the 'cart' item from the session

        return redirect()->route('cart.show')
            ->with('alert-msg', 'The cart has been cleared successfully!')
            ->with('alert-type', 'success');
    }
}
