<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('categories', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = new Post();
        return view('admin.posts.create', compact('tags', 'categories', 'post'));
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
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
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

        $img_path = Storage::put('public', $data['attachment_cover']);
        $post->attachment_cover = $img_path;
        $post->save();

        //* Per creare la relazione tra le due tabelle, devo compilare la tabella pivot con il metodo attach()
        //! MA...solo se mi arriva tags (cioè se la tabella tags è piena di elementi tag) nei $data
        if(array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);

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
        $tags = Tag::all();
        $tagIdsArray = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('tags', 'post', 'tagIdsArray', 'categories'));
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
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
            ], 
            ['required' => 'Il campo :attribute è obbligatorio',
             'min' => 'Il numero minimo di caratteri per il campo :attribute è :min',
             'title.unique' => 'Il titolo esiste già',
             'image.string' => "L'url dell'immagine deve essere una stringa di caratteri"
            ],
        );

        $data = $request->all();
        $data['slug']=Str::slug($data['title'], '-');

        if(!array_key_exists('tags', $data)) $post->tags()->detach();
        else $post->tags()->sync($data['tags']);

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
        if(count($post->tags)) $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('alert-message', 'Post eliminato!')->with('alert-type', 'info');
    }
}
