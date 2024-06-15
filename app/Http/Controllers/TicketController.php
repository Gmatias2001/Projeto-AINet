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

    if (!$ticket) {
        return back()->with('error', 'Erro ao criar o bilhete.');
    }

    // Adicionar o bilhete ao carrinho (seção)
    $cart = $request->session()->get('cart', []);
    $cart[] = $ticket->id;
    $request->session()->put('cart', $cart);

    // Redirecionar para a página do carrinho
    return redirect()->route('cart.show')->with('success', 'Bilhete adicionado ao carrinho com sucesso.');

}


    private function generateQrCodeUrl()
    {
        // Implemente a lógica de geração do QR code aqui
        return 'generated_qr_code_url';
    }


}
