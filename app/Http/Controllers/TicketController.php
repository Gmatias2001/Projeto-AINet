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
        // Validate the form data
        $request->validate([
            'screening_id' => 'required|exists:screenings,id',
            'seat_id' => 'required|exists:seats,id',
        ]);

        // Retrieve movie and screening details for the ticket
        $movie = Movie::findOrFail($movieId);
        $screening = Screening::findOrFail($screeningId);

        // Create a new Ticket instance using the create method
        $ticket = Ticket::create([
            'screening_id' => $screening->id,
            'seat_id' => $request->seat_id,
            'purchase_id' => null, // Assuming a purchase will be created later
            'price' => 10.00, // Set a default price or retrieve from the screening or seat
            'qrcode_url' => $this->generateQrCodeUrl(),
            'status' => 'pending', // Assuming default status is pending
        ]);

        // Add movie details to the ticket for display purposes
        $ticket->movie_name = $movie->title;
        $ticket->session_date = $screening->date;
        $ticket->session_time = $screening->start_time;

        // Retrieve the cart from the session, or initialize a new collection if it doesn't exist
        $cart = collect(session('cart', []));

        // Check if the ticket is already in the cart
        if ($cart->contains('id', $ticket->id)) {
            $alertType = 'warning';
            $htmlMessage = "Ticket for movie <strong>\"{$ticket->movie_name}\"</strong> on <strong>{$ticket->session_date} at {$ticket->session_time}</strong> was not added to the cart because it is already there!";
        } else {
            $cart->push($ticket);
            $request->session()->put('cart', $cart);
            $alertType = 'success';
            $htmlMessage = "Ticket for movie <strong>\"{$ticket->movie_name}\"</strong> on <strong>{$ticket->session_date} at {$ticket->session_time}</strong> has been added to your cart!";
        }

        // Redirect to cart page with a success message
        return redirect()->route('cart.show')->with('alert-msg', $htmlMessage)->with('alert-type', $alertType);
    }


    private function generateQrCodeUrl()
    {
        // Implemente a lógica de geração do QR code aqui
        return 'generated_qr_code_url';
    }


}
