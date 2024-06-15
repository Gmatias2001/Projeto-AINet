<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class CartController extends Controller
{
    public function show()
    {
        $itens = \Cart::getContent();
    }


    private function generateQrCodeUrl()
    {
        // Implemente a lógica de geração do QR code aqui
        return 'generated_qr_code_url';
    }

    public function removeFromCart(Request $request, $ticketId)
    {
        $cart = $request->session()->get('cart', []);
        $cart = array_diff($cart, [$ticketId]);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Bilhete removido do carrinho com sucesso.');
    }


    public function checkout(Request $request)
    {
        // Lógica de checkout aqui (pode incluir processamento de pagamento, criação de pedido, etc.)

        // Limpar o carrinho após o checkout
        $request->session()->forget('cart');

        return redirect()->route('home')->with('success', 'Compra realizada com sucesso!');
    }
}