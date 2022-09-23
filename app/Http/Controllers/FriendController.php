<?php

namespace App\Http\Controllers;

use App\Models\friend;
use App\Http\Requests\StorefriendRequest;
use App\Http\Requests\UpdatefriendRequest;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorefriendRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorefriendRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show(friend $friend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatefriendRequest  $request
     * @param  \App\Models\friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatefriendRequest $request, friend $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(friend $friend)
    {
        //
    }
}
