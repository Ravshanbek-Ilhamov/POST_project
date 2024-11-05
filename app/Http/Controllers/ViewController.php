<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreViewRequest;
use App\Http\Requests\UpdateViewRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\View;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $views = View::paginate(15);
        $posts = Post::all();
        $users = User::all();
        return view('admin.view.view',['views'=>$views,'posts'=>$posts,'users'=>$users]);
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
    public function store(StoreViewRequest $request)
    {
        $view = new View();

        $view->post_id = $request->post_id;
        $view->user_IP = $request->user_IP;

        $view->save();
        return redirect()->route('view.index')->with('success','View added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(View $view)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(View $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateViewRequest $request, View $view)
    {
        $view->update([
            'post_id' => $request->post_id,
            'user_IP' => $request->user_IP,
        ]);
        return redirect()->route('view.index')->with('success','View updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(View $view)
    {
        if($view){
            $view->delete();
            return redirect()->route('view.index')->with('success','View deleted successfully');
        }
        return redirect()->route('view.index')->with('success','Error While Deleting View');
    }
}
