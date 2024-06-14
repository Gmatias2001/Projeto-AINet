<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Screening;
use App\Models\Seat;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function showPurchasePage()
    {
        $screenings = Screening::all();
        $seats = Seat::all();

        return view('tickets.purchase', compact('screenings', 'seats'));
    }

    public function purchaseTicket(Request $request)
    {
        $ticket = Ticket::create([
            'screening_id' => $request->input('screening_id'),
            'seat_id' => $request->input('seat_id'),
            'price' => config('app.ticket_price'), // ou outro valor apropriado
            'qrcode_url' => 'gerar_qr_code_url_aqui', // Implementar geração de QR code
            'status' => 'valid'
        ]);

        return redirect()->route('tickets.success', ['ticket' => $ticket->id]);
    }
}

//FEITO PELO CHATGPT
