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
                <div class="d-flex justify-content-end">
                    <a href="{{route('admin.posts.index')}}" class="btn btn-primary mr-2">Indietro</a>
                    <a class="btn btn-warning mr-2" href="{{route('admin.posts.edit', $post->id)}}">Modifica</a>
                    <form method='POST' action="{{route('admin.posts.destroy', $post->id)}}" class="delete-post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancella</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    const deletePost = document.querySelectorAll('.delete-post'); 
    deletePost.forEach(item =>{
        item.addEventListener('submit', function (event) {
            event.preventDefault();
            const confirmEvent = confirm('Vuoi realmente eliminare questo Post?');
            if (confirmEvent) this.submit();
        })
    })
</script>
    
@endsection