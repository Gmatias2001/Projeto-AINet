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


    private function generateQrCodeUrl()
    {
        // Implemente a lógica de geração do QR code aqui
        return 'generated_qr_code_url';
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
        $request->session()->put('cart', $cart);
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
        // Lógica de checkout aqui (pode incluir processamento de pagamento, criação de pedido, etc.)

        // Limpar o carrinho após o checkout
        $request->session()->forget('cart');

        return redirect()->route('home')->with('success', 'Compra realizada com sucesso!');
    }
}