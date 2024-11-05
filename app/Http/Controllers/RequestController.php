<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use App\Models\Request;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = Request::paginate(15);
        return view('admin.request.request',['requests' => $requests]);
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
    public function store(StoreRequestRequest $request)
    {
        $requests = new Request();
        $requests->create([
            'text'=> $request->text,
        ]);
        return redirect()->route('request.index')->with('success','New Request created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // use Illuminate\Http\Request;

    public function update(Request $request, $id)
    {
        dd($request->all(),$id);
        
        $request->validate([
            'text' => 'required|string|max:255',
            'number_people' => 'required|integer|min:1',
        ]);
    
        $requestItem = Request::find($id); 
    
        if (!$requestItem) {
            return redirect()->back()->with('error', 'Request not found');
        }

        $requestItem->update([
            'text'=>$request->input('text'),
            'number_people'=> $request->input('number_people'),
        ]);
    
        return redirect()->route('requests.index')->with('success', 'Request updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
