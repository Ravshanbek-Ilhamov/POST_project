<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOptionsRequest;
use App\Http\Requests\UpdateOptionsRequest;
use App\Models\Options;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options = Options::paginate(15);
        return view('admin.options.options',['options'=>$options]);
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
    public function store(StoreOptionsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Options $options)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Options $options)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOptionsRequest $request, Options $options)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Options $options)
    {
        //
    }
}
