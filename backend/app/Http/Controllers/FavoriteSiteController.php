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
        return "index";
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
        return $favoriteSite;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FavoriteSite  $favoriteSite
     * @return \Illuminate\Http\Response
     */
    public function show(FavoriteSite $favoriteSite)
    {
        return "show";
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
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FavoriteSite  $favoriteSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoriteSite $favoriteSite)
    {
        return "destroy";
    }
}