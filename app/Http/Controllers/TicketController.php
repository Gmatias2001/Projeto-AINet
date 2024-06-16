<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Movie;
use App\Models\Screening;
use App\Models\Seat;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller
{
    public function showPurchasePage($movieId, $date)
    {
        $movie = Movie::findOrFail($movieId);
        $screening = Screening::where('movie_id', $movieId)->where('date', $date)->firstOrFail();
        $seats = Seat::all();
        $screenings = Screening::where('movie_id', $movieId)->get();

        return view('tickets.purchase', compact('movie', 'screening', 'seats', 'screenings'));
    }

    public function purchaseTicket(Request $request, $movieId, $screeningId)
    {
        $request->validate([
            'screening_id' => 'required|exists:screenings,id',
            'seat_id' => 'required|exists:seats,id',
        ]);

        $movie = Movie::findOrFail($movieId);
        $screening = Screening::findOrFail($screeningId);
        $seat = Seat::findOrFail($request->seat_id);

        // Cria o ticket com base nos dados fornecidos
        $ticket = Ticket::create([
            'screening_id' => $screening->id,
            'seat_id' => $seat->id,
            'purchase_id' => null,
            'price' => $screening->ticket_price, // Supondo que o preço do ingresso seja obtido da sessão de cinema
            'qrcode_url' => $this->generateQrCodeUrl(),
            'status' => 'pending',
            'movie_name' => $movie->title,
            'session_date' => $screening->date,
            'session_time' => $screening->start_time,
        ]);

        // Adiciona o ticket ao carrinho na sessão
        $cart = collect(Session::get('cart', []));
        $cart->push($ticket);
        Session::put('cart', $cart);

        // Mensagem de sucesso
        $alertType = 'success';
        $htmlMessage = "Ticket para o filme <strong>\"{$movie->title}\"</strong> em <strong>{$screening->date} às {$screening->start_time}</strong> foi adicionado ao seu carrinho.Assento: Fila {$seat->row}, Assento {$seat->seat_number}";

        // Redireciona para a página de carrinho com a mensagem de alerta
        return redirect()->route('cart.show')->with('alert-msg', $htmlMessage)->with('alert-type', $alertType);
    }

    private function generateQrCodeUrl()
    {
        // Implemente a lógica de geração do QR code aqui
        return 'generated_qr_code_url';
    }
}
