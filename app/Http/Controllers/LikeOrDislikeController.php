<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikeOrDislikeRequest;
use App\Http\Requests\UpdateLikeOrDislikeRequest;
use App\Models\LikeOrDislike;

class LikeOrDislikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $likes = LikeOrDislike::paginate(15);
        return view('admin.like.likes',['likes'=>$likes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLikeOrDislikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LikeOrDislike $likeOrDislike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LikeOrDislike $likeOrDislike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLikeOrDislikeRequest $request, LikeOrDislike $likeOrDislike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LikeOrDislike $likeOrDislike)
    {
        //
    }
}
