<?php

namespace App\Http\Controllers;

use App\FavoriteSite;
use Illuminate\Http\Request;

class FavoriteSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('favorite-sites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $favoriteSite = new FavoriteSite();
        $favoriteSite->title = $request->title;
        $favoriteSite->url = $request->url;
        $favoriteSite->save();
        return redirect('favorite-sites');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FavoriteSite  $favoriteSite
     * @return \Illuminate\Http\Response
     */
    public function show(FavoriteSite $favoriteSite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FavoriteSite  $favoriteSite
     * @return \Illuminate\Http\Response
     */
    public function edit(FavoriteSite $favoriteSite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FavoriteSite  $favoriteSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FavoriteSite $favoriteSite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FavoriteSite  $favoriteSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoriteSite $favoriteSite)
    {
        //
    }
}