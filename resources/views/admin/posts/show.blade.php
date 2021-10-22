@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{$post->title}}</h5>
            </div>
            <div class="card-body">
                <p>{{$post->content}}</p>
                <address>Pubblicato il: {{$post->getFormattedDate('created_at')}}</address>
                <address>Categoria: @if ($post->category) {{$post->category->name}} @else Nessuna categoria @endif</address>
                <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Indietro</a>
            </div>
        </div>
    </div>
</section>
@endsection