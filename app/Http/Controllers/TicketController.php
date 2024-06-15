<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Screening;
use App\Models\Seat;
use App\Models\Ticket;
use App\Models\Movie;

class TicketController extends Controller
{
    public function showPurchasePage($movieId, $date)
{
    $movie = Movie::findOrFail($movieId);
    $screening = Screening::where('movie_id', $movieId)->where('date', $date)->firstOrFail();
    $seats = Seat::all();
    $screenings = Screening::where('movie_id', $movieId)->get(); // Adicione esta linha para obter todas as sessões disponíveis

    return view('tickets.purchase', compact('movie', 'screening', 'seats', 'screenings'));
}



public function purchaseTicket(Request $request, $movieId, $screeningId)
{
    $ticket = Ticket::create([
        'screening_id' => $screeningId,
        'seat_id' => $request->input('seat_id'),
        'price' => config('app.ticket_price'), // Utilize uma configuração apropriada para o preço do bilhete
        'qrcode_url' => $this->generateQrCodeUrl(), // Implemente a lógica de geração do QR code
        'status' => 'valid'
    ]);

    return redirect()->route('tickets.success', ['ticket' => $ticket->id]);
}


    public function showSuccessPage($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);

        return view('tickets.success', compact('ticket'));
    }

    private function generateQrCodeUrl()
    {
        // Implement the QR code generation logic here
        return 'generated_qr_code_url';
    }
}
