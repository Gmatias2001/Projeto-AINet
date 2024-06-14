<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class lista_movie extends Controller
{
    
    public function lista_movie()
    {
        return view('lista_movie'); 
    }
}