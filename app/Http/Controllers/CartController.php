<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Purchase;
use App\Services\Payment;

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
        $discount = $user ? config('settings.member_discount') : 0;

        return view('checkout.form', compact('cart', 'user', 'discount'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nif' => 'nullable|string|max:20',
            'tipo_pagamento' => 'required|string|in:visa,paypal,mbway',
        ]);

        $tipoPagamento = $request->tipo_pagamento;

        // Redireciona para o formulário específico com base no tipo de pagamento selecionado
        switch ($tipoPagamento) {
            case 'visa':
                return redirect()->route('visa.form');
            case 'paypal':
                return redirect()->route('paypal.form');
            case 'mbway':
                return redirect()->route('mbway.form');
            default:
                // Caso nenhum método de pagamento válido seja selecionado, redireciona para o formulário de checkout padrão
                return redirect()->route('checkout.form')->with('alert-msg', 'Selecione um método de pagamento válido.')->with('alert-type', 'error');
        }
    }

    /**
     * Exibe o formulário específico para pagamento Visa.
     */
    public function showVisaForm()
    {
        return view('visa.form');
    }

    /**
     * Processa o formulário específico para pagamento Visa.
     */
    public function processVisa(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string|digits:16',
            'cvc_code' => 'required|string|digits:3',
        ]);

        // Processamento específico do pagamento Visa

        return redirect()->route('movies')->with('success', 'Pagamento Visa concluído com sucesso!');
    }

    /**
     * Exibe o formulário específico para pagamento PayPal.
     */
    public function showPaypalForm()
    {
        return view('paypal.form');
    }

    /**
     * Processa o formulário específico para pagamento PayPal.
     */
    public function processPaypal(Request $request)
    {
        $request->validate([
            'paypal_email' => 'required|email|max:255',
        ]);

        // Processamento específico do pagamento PayPal

        return redirect()->route('movies')->with('success', 'Pagamento PayPal concluído com sucesso!');
    }

    /**
     * Exibe o formulário específico para pagamento MBWay.
     */
    public function showMbwayForm()
    {
        return view('mbway.form');
    }

    /**
     * Processa o formulário específico para pagamento MBWay.
     */
    public function processMbway(Request $request)
    {
        $request->validate([
            'mbway_number' => 'required|string|max:20',
        ]);

        // Processamento específico do pagamento MBWay

        return redirect()->route('movies')->with('success', 'Pagamento MBWay concluído com sucesso!');
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('cart'); // Remove 'cart' session item

        return redirect()->route('cart.show')->with('alert-msg', 'Cart cleared successfully!')->with('alert-type', 'success');
    }
}
