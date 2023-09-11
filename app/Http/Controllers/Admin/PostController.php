<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
            'content' => 'required',
        ]);

        $imagePath = $request->file('image')->store('uploads', 'public');

        Post::create([
            'title' => $request->input('title'),
            'image' => $imagePath,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Il post è stato creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    private function deleteImageFromStorage($imagePath)
    {
        if (!empty($imagePath)) {
            Storage::delete($imagePath);
        }
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'image',
            'content' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteImageFromStorage($post->image);
            $imagePath = $request->file('image')->store('uploads', 'public');
            $post->update([
                'image' => $imagePath,
            ]);
        }

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Il post è stato aggiornato con successo.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->deleteImageFromStorage($post->image);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Il post è stato eliminato con successo.');
    }
}
