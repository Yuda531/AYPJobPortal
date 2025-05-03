<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PostsController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $jobSeeker = $user->jobSeeker;
        $posts = Posts::with('user')->latest()->get();

        // Get 3 random users excluding the current user
        $suggestedUsers = User::where('id', '!=', $user->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('dashboard', compact('posts', 'user', 'jobSeeker', 'suggestedUsers'));
    }


    // public function create()
    // {
    //     //
    // }


    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $post = new Posts();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $binaryData = file_get_contents($image->getRealPath());
            $post->image = $binaryData;
        }

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }


    // public function show($id)
    // {
    //     //
    // }


    // public function edit($id)
    // {
    //     //
    // }


    public function update(Request $request, $id)
    {
        $post = Posts::findOrFail($id);

        // Check if the authenticated user is the author of the post
        if ($post->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this post.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $binaryData = file_get_contents($image->getRealPath());
            $post->image = $binaryData;
        }

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    }


    public function destroy($id)
    {
        $post = Posts::findOrFail($id);

        // Check if the authenticated user is the author of the post
        if ($post->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }

        $post->delete();
        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }
}
