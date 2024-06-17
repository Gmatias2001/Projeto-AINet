<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Movie;
use App\Models\Screening;
use App\Models\Seat;
use App\Models\Purchase;
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
            'price' => $screening->ticket_price,
            'qrcode_url' => $this->generateQrCodeUrl(),
            'status' => 'pending',
            'movie_name' => $movie->title,
            'session_date' => $screening->date,
            'session_time' => $screening->start_time,
        ]);

        $cart = collect(session('cart', []));

        $exists = $cart->contains(function ($cartItem) use ($ticket) {
            return $cartItem->screening_id == $ticket->screening_id
                && $cartItem->seat_id == $ticket->seat_id;
        });

        if ($exists) {
            $alertType = 'warning';
            $htmlMessage = "Ticket for movie <strong>\"{$movie->title}\"</strong> on <strong>{$screening->date} at {$screening->start_time}</strong> was not added to the cart because it is already there!";
        } else {
            $cart->push($ticket);
            $request->session()->put('cart', $cart);
            $alertType = 'success';
            $htmlMessage = "Ticket for movie <strong>\"{$movie->title}\"</strong> on <strong>{$screening->date} at {$screening->start_time}</strong> has been added to your cart!";
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
