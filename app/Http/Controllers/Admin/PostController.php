<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $post = new Post();
        return view('admin.posts.create', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:posts|min:3|max:50',
            'content' => 'required|string',
            'image' => 'string',
            ], 
            ['required' => 'Il campo :attribute è obbligatorio',
             'min' => 'Il numero minimo di caratteri per il campo :attribute è :min',
             'title.unique' => 'Il titolo esiste già',
             'image.string' => "L'url dell'immagine deve essere una stringa di caratteri"
            ],
        );

        $data = $request->all();
        $post = new Post();
        $post->fill($data);
        $post->slug=Str::slug($post->title, '-');
        $post->save();

        return redirect()->route('admin.posts.show', compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id),'min:3','max:50'],
            'content' => 'required|string',
            'image' => 'string',
            ], 
            ['required' => 'Il campo :attribute è obbligatorio',
             'min' => 'Il numero minimo di caratteri per il campo :attribute è :min',
             'title.unique' => 'Il titolo esiste già',
             'image.string' => "L'url dell'immagine deve essere una stringa di caratteri"
            ],
        );

        $data = $request->all();
        $data['slug']=Str::slug($data['title'], '-');
        $post->update($data);

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('alert-message', 'Post eliminato!')->with('alert-type', 'info');
    }
}
