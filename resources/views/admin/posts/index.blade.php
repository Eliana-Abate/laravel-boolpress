@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <h1>Elenco post:</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->getFormattedDate('created_at')}}</td>
                        <td>{{$post->getFormattedDate('updated_at')}}</td>
                        <td>
                            <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary">Mostra</a>
                        </td>
                    </tr>
                    
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-danger">Non sono presenti post</td>
                    </tr>
                    
                @endforelse
             
            </tbody>
          </table>

    </div>
</section>
    
@endsection