<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Http\Requests\ValidateBlogPost;
use Illuminate\Http\Request;


class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all blog Posts
        return view('posts.index', ['posts' => BlogPost::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Create a New Blog Post
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateBlogPost $blogPost)
    {
        // Persist the Post to the DB

        // Run through the validator first
        $validated = $blogPost->validated();

        // only validated fillable form inputs will be added to DB
        $post = BlogPost::create($validated);

        $blogPost->session()->flash('status', 'Post created Successfully');

        return redirect(route('posts.show', ['post' => $post->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $BlogPost, $id)
    {
        // Show the Individual Post
        return view('posts.show', ['post' => blogPost::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $BlogPost, $id)
    {
        // Show a form for the user to edit a post
        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateBlogPost $blogPost, $id)
    {
        // Validate data, grab post from DB, Update post, redirect
        $validated = $blogPost->validated();
        $post = BlogPost::findOrFail($id);
        $post->fill($validated);
        $post->save();

        $blogPost->session()->flash('status', 'Post updated successfully!');

        return redirect(route('posts.show', ['post' => $post->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Delete post from DB
        $post = BlogPost::findOrFail($id);
        $post->delete();

        $request->session()->flash('status', 'Blog Post successfully deleted!');

        return redirect(route('posts.index'));
    }
}
