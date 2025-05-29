<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::create($validated);
        return response()->json($post,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([

            'title' => 'sometimes|required|max:255',
            'content' => 'sometimes| required| string',

        ]);

        $post->update($validated);
        return response()->json($post,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        $post->delete();
        return response()->json(null,204);
        
    }
}
