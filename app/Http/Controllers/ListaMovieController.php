<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Movie;

class  ListaMovie extends Controller
{
    

public function index(): View 
{ 
    $allMovies = Movie::paginate(20); 
    return view('lista_movies')->with('movies', $allMovies); 
} 

}

