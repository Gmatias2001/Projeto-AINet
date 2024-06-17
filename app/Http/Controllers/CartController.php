<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Purchase;
use App\Services\Payment; // Importando a classe Payment corretamente

class CartController extends Controller
{
    public function showCart()
    {
        $cart = collect(session('cart', []));
        return view('cart.show', compact('cart'));
    }

    public function removeFromCart(Request $request, $ticketId)
    {
        $cart = collect(session('cart', []));

        $ticketIndex = $cart->search(function ($ticket) use ($ticketId) {
            return $ticket['id'] == $ticketId;
        });

        if ($ticketIndex !== false) {
            $cart->forget($ticketIndex);
            $request->session()->put('cart', $cart->values()->all());
            $alertType = 'success';
            $alertMsg = 'Ticket removed from your cart.';
        } else {
            $alertType = 'error';
            $alertMsg = 'Ticket not found in the cart.';
        }

        return redirect()->route('cart.show')->with('alert-msg', $alertMsg)->with('alert-type', $alertType);
    }

    public function showCheckoutForm(Request $request)
    {
        $cart = collect(session('cart', []));

        if ($cart->isEmpty()) {
            return redirect()->route('cart.show')->with('alert-msg', 'Your cart is empty.')->with('alert-type', 'error');
        }

        $user = Auth::user();
        $discount = $user ? 0.1 : 0; // Desconto de 10% para usuários logados

        return view('checkout.form', compact('cart', 'user', 'discount'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nif' => 'nullable|string|max:20',
            'tipo_pagamento' => 'required|string|in:visa,paypal,mbway',
            'ref_pagamento' => 'required|string',
            'cvc_code' => 'required_if:tipo_pagamento,visa|string|digits:3',
        ]);

        $tipoPagamento = $request->tipo_pagamento;
        $refPagamento = $request->ref_pagamento;

        switch ($tipoPagamento) {
            case 'visa':
                $paymentValid = Payment::payWithVisa($refPagamento, $request->cvc_code);
                break;
            case 'paypal':
                $paymentValid = Payment::payWithPaypal($refPagamento);
                break;
            case 'mbway':
                $paymentValid = Payment::payWithMBway($refPagamento);
                break;
            default:
                $paymentValid = false;
        }

        if (!$paymentValid) {
            return redirect()->route('checkout.form')->with('alert-msg', 'Pagamento inválido. Verifique os dados e tente novamente.')->with('alert-type', 'error');
        }

        $purchase = $this->savePurchaseDetails($request, $tipoPagamento);

        if (!$purchase) {
            return redirect()->route('checkout.form')->with('alert-msg', 'Erro ao processar a compra. Tente novamente mais tarde.')->with('alert-type', 'error');
        }

        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Compra realizada com sucesso!');
    }

    private function savePurchaseDetails(Request $request, $paymentMethod)
    {
        $cart = collect(session('cart', []));
        $user = Auth::user();
        $ticket_price = 9.0;
        $total = count($cart) * $ticket_price;

        if ($user) {
            $total *= 0.9; // Aplicar 10% de desconto se o usuário estiver logado
        }

        // Criar um novo registro de compra
        $purchase = Purchase::create([
            'customer_id' => $user ? $user->id : null,
            'date' => Carbon::now(),
            'total_price' => $total,
            'customer_name' => $user ? $user->name : $request->nome,
            'customer_email' => $user ? $user->email : $request->email,
            'nif' => $request->nif,
            'payment_type' => $paymentMethod,
            'payment_ref' => $request->ref_pagamento, // Usando a mesma referência para todos os tipos de pagamento
            'receipt_pdf_filename' => null, // Adicionar lógica para gerar o recibo em PDF, se necessário
        ]);

        // Adicionar tickets relacionados à compra
        foreach ($cart as $item) {
            $purchase->ticketRef()->create([
                'screening_id' => $item['screening_id'],
                'seat_id' => $item['seat_id'],
                'price' => $ticket_price,
            ]);
        }

        return $purchase;
    }
}
