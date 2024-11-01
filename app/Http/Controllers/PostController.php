<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(15);
        return view('admin.post.posts',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.post_create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();
    
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images/post_images', 'public');
            $validatedData['image_path'] = $imagePath;
        }
    
        $validatedData['likes'] = $validatedData['likes'] ?? 0;
        $validatedData['dislikes'] = $validatedData['dislikes'] ?? 0;
        $validatedData['number_view'] = $validatedData['number_view'] ?? 0;
    
        Post::create($validatedData);
    
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
    
        return view('admin.post.post_edit', ['categories' => $categories, 'post' => $post]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($request->hasFile('image_path')) {
            if ($post->image_path) {
                Storage::delete($post->image_path);
            }
            
            $imagePath = $request->file('image_path')->store('images');
            $post->image_path = $imagePath;
        }
    
        $post->update([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'text' => $request->input('text'),
            'likes' => $request->input('likes', $post->likes),
            'dislikes' => $request->input('dislikes', $post->dislikes),
            'number_view' => $request->input('number_view', $post->number_view),
        ]);
    
        return redirect()->route('post.index')->with('success', 'Post updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            if ($post) {
                $post->delete();
                return redirect()->back()->with('success', 'Post deleted successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete post');
        }
    
        return redirect()->back()->with('error', 'Post not found');
    }
}
