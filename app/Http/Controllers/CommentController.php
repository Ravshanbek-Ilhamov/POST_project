<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::paginate(15);
        $posts = Post::all();
        return view('admin.comment.comments',['comments'=>$comments,'posts'=>$posts]);
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
    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->text = $request->text;
        $comment->user_id = auth()->user()->id;

        $comment->save();
        return redirect('/comments')->with('success', 'Comment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        // dd($request->all(),$comment);
        $comment->update([
            'post_id' => $request->post_id,
            'user_id' => auth()->user()->id,
            'text' => $request->text,
        ]);

        return redirect()->route('comment.index')->with('success', 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
            session()->flash('success', 'Comment deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'There was an issue deleting the comment.');
        }
        return redirect('/comments');
    }
}
