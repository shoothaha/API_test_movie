<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Movie;
use App\Http\Resources\MovieResource;
use App\Http\Requests\MovieRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::orderby('name')->paginate(15);
        return MovieResource::collection($movies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        $movie = new Movie();
        $movie->name = $request->name;
        $movie->description = $request->description;
        $movie->genre = $request->genre;
        $movie->release_date = $request->release_date;
        $movie->director = $request->director;
        $movie->running_time =$request->running_time;
        $movie->rating = $request->rating;

        if ($movie->save()){
            return new MovieResource($movie);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return new MovieResource($movie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(MovieRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $movie->name = $request->name;
        $movie->description = $request->description;
        $movie->genre = $request->genre;
        $movie->release_date = $request->release_date;
        $movie->director = $request->director;
        $movie->running_time =$request->running_time;
        $movie->rating = $request->rating;

        if($movie->save()){
            return new MovieResource($movie);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        
        if ($movie->delete()){
            // Session::flash('success', 'You have successfully deleted the movie!');
            $movies = Movie::orderby('name')->paginate(15);
            return MovieResource::collection($movies);
        };
    }
}
