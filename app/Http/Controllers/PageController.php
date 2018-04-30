<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class PageController extends Controller
{
    public function getIndex(){
        return view('welcome');
    }
    
    public function getMovies(){
        $movies = Movie::orderby('name', 'desc')->limit(5)->get();
    	return view('movies.index')->with('movies', $movies);
    }
}
