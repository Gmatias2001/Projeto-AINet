<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Screening;
use App\Models\Seat;
use Illuminate\View\View;

class SeatSelectionController extends Controller
{
    public function showSeats($id, $date): View
    {
        // Encontrar a sessão específica do filme
        $screening = Screening::where('movie_id', $id)
                              ->where('date', $date)
                              ->firstOrFail();

        // Encontrar todos os assentos disponíveis para esta sessão
        $seats = Seat::where('theater_id', $screening->theater_id)
                     ->orderBy('row')
                     ->orderBy('seat_number')
                     ->get();

        return view('seat_selection', [
            'screening' => $screening,
            'seats' => $seats,
        ]);
    }

    // Outros métodos como purchase e purchaseSuccess podem ser adicionados conforme necessário
}
