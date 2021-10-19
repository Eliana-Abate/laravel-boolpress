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
                    <input type="text" class="form-control @error ('title')is-invalid @enderror" id="title" name="title" value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <label for="content" class="form-label">Descrizione</label>
                    <textarea class="form-control  @error ('content')is-invalid @enderror"  rows="3" id="content" name="content" style="height: 100px">{{$post->content}}</textarea>
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Url immagine</label>
                    <input type="text" class="form-control @error ('image')is-invalid @enderror" id="image" name="image" value="{{$post->image}}">
                </div>
               
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