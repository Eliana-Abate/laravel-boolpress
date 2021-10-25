@extends('layouts.app')

@section('content') 

<section id="form-create" class="pt-5">
    <h1 class="text-center pb-5">Modifica il Post</h1>
    <div class="container pb-5">
        <div class="border border-primary p-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{route('admin.posts.update', $post->id)}}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control @error ('title')is-invalid @enderror" id="title" name="title" value="{{old('title', $post->title)}}">
                </div>
                <div class="form-group">
                    <label for="content" class="form-label">Descrizione</label>
                    <textarea class="form-control  @error ('content')is-invalid @enderror"  rows="3" id="content" name="content" style="height: 100px">{{old('content', $post->content)}}</textarea>
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Url immagine</label>
                    <input type="text" class="form-control @error ('image')is-invalid @enderror" id="image" name="image" value="{{old('image', $post->image)}}">
                </div>

                <div class="form-group">
                    <label for="category_id" class="form-label">Categoria</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">Nessuna categoria</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if(old('category_id', $post->category_id) == $category->id)selected @endif>{{$category->name}}</option>
                            
                        @endforeach
                    </select>  
                </div>

                <div>
                    <h6>Check tags:</h6>
                </div>
                @foreach ($tags as $tag)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="tag-{{$tag->id}}" value="{{$tag->id}}" name="tags[]" @if (in_array($tag->id, old('tags', $tagIdsArray ?? []))) checked @endif>
                    <label class="form-check-label" for="tag-{{$tag->id}}">{{$tag->name}}</label>
                </div>
                    
                @endforeach
               
                <div class="d-flex justify-content-center mt-5">
                    <a class="btn btn-warning mr-3" href="{{route('admin.posts.index')}}">Indietro</a>
                    <button type="reset" class="btn btn-secondary mr-3">Reset</button>
                    <button type="submit" class="btn btn-primary">Salva modifiche</button>
                </div>
                
            </form>
        </div> 
    </div>
</section>

@endsection