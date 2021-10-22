@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        @if (session('alert-message'))
            <div class="alert alert-{{session('alert-type')}}">
                {{session('alert-message')}}
            </div>
            
        @endif
        <header class="d-flex align-items-center justify-content-between pb-5">
            <h1>Elenco post:</h1>
            <a class="btn btn-primary" href="{{route('admin.posts.create')}}">Crea post</a>
        </header>
        
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Categoria</th>
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
                        <td> @if ($post->category) {{$post->category->name}} @else - @endif</td>
                       
                        <td>{{$post->getFormattedDate('created_at')}}</td>
                        <td>{{$post->getFormattedDate('updated_at')}}</td>
                        <td class="d-flex justify-content-end">
                            <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary mr-2">Mostra</a>
                            <a class="btn btn-warning mr-2" href="{{route('admin.posts.edit', $post->id)}}">Modifica</a>
                            <form method='POST' action="{{route('admin.posts.destroy', $post->id)}}" class="delete-post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Cancella</button>
                            </form>
                        </td>
                    </tr>
                    
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-danger">Non sono presenti post</td>
                    </tr>
                @endforelse
             
            </tbody>
          </table>

          <footer>
              <div class="d-flex justify-content-center pt-5">
                  {{$posts->links()}}
              </div>
          </footer>

          <hr>

          <section id="grouped-post" class="mt-5">
              <div class="row">
                  @foreach ($categories as $category)
                  <div class="col-4">
                      <h4 class="mb-3">{{$category->name}}</h4>
                      @forelse ($category->posts as $post)
                        <h6><a href="{{route('admin.posts.show', $post->id)}}">#{{$post->id}} - {{$post->title}}</a></h6>
                          
                      @empty
                        Nessun post in questa categoria.
                          
                      @endforelse
                  </div>
                      
                  @endforeach

              </div>

          </section>
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