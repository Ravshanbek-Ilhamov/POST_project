<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikeOrDislikeRequest;
use App\Http\Requests\UpdateLikeOrDislikeRequest;
use App\Models\LikeOrDislike;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeOrDislikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $likes = LikeOrDislike::paginate(15);
        $posts = Post::all();
        $users = User::all();

        return view('admin.like.likes',[
            'likes'=>$likes,
            'posts'=>$posts,
            'users'=>$users
        ]);
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
    public function store(StoreLikeOrDislikeRequest $request){    
        LikeOrDislike::create([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'value' => $request->value
        ]);
    
        return redirect()->route('like.index')->with('success', 'Like added successfully.');
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
        $likeOrDislike->update([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'value' => $request->value,
        ]);

        return redirect()->route('like.index')->with('success','Like updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LikeOrDislike $likeOrDislike)
    {
    
        $likeOrDislike->delete();
    
        return redirect()->route('like.index')->with('success', 'Like deleted successfully');
    }


    public function likes(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $existingReaction = LikeOrDislike::where('post_id', $request->post_id)
            ->where('user_id', auth()->id())
            ->first();
    
        if ($existingReaction) {
            if ($existingReaction->value == 1) {
                $existingReaction->delete();
                $post->decrement('likes');
            } else {
                $existingReaction->update(['value' => 1]);
                $post->increment('likes');
                $post->decrement('dislikes');
            }
        } else {
            LikeOrDislike::create([
                'post_id' => $request->post_id,
                'user_id' => auth()->id(),
                'value' => 1
            ]);
            $post->increment('likes');
        }
    
        return redirect()->back();
    }
    
    public function dislikes(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $existingReaction = LikeOrDislike::where('post_id', $request->post_id)
            ->where('user_id', auth()->id())
            ->first();
    
        if ($existingReaction) {
            if ($existingReaction->value == 0) {
                $existingReaction->delete();
                $post->decrement('dislikes');
            } else {
                $existingReaction->update(['value' => 0]);
                $post->decrement('likes');
                $post->increment('dislikes');
            }
        } else {
            LikeOrDislike::create([
                'post_id' => $request->post_id,
                'user_id' => auth()->id(),
                'value' => 0
            ]);
            $post->increment('dislikes');
        }
    
        return redirect()->back();
    }
    

    public function toggleReaction(Request $request, $postId)
    {
        dd($request->all(),$postId);
        $request->validate([
            'reaction' => 'required|in:like,dislike',
        ]);
    
        $reactionValue = $request->reaction === 'like' ? 1 : 0;
        $userId = auth()->id();
    
        // Find the existing reaction
        $existingReaction = LikeOrDislike::where('user_id', $userId)
                               ->where('post_id', $postId)
                               ->first();
    
        if ($existingReaction) {
            // Update the reaction if it's different
            if ($existingReaction->value !== $reactionValue) {
                $existingReaction->value = $reactionValue;
                $existingReaction->save();
            }
        } else {
            // Create a new reaction if none exists
            LikeOrDislike::create([
                'user_id' => $userId,
                'post_id' => $postId,
                'value' => $reactionValue,
            ]);
        }
    
        // Increment the number_view for the post
        $post = Post::find($postId);
        $post->increment('number_view');
    
        return redirect()->back();
    }
    
    

    
}
