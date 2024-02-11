@extends('layouts.front-end')

@section('content')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Social World!</h1>
                <p class="lead mb-0">live in the unlimited sky</p>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{url('posts')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="title" class="form-control @error('title')is-invalid @enderror" id="title"  placeholder="Share your thoughts" value="{{old('title')}}">
                        @error('title')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="3" placeholder="Enter content...">{{old('body')}}</textarea>
                        @error('body')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="d-grid gap-2 mb-3">
                        <button class="btn text-white" style="background-color: #836FFF" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-md-8 offset-md-2">
                <!-- Featured blog post-->
                @foreach ($posts as $post)
                    <div class="card mb-4">

                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="small text-muted">Created at {{date('d-M-Y',strtotime($post->created_at))}}</div>
                                @if(Auth::check())
                                    @if(Auth::user()->id == $post->user_id)
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <form action="{{url('posts/'.$post->id)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <li>
                                                    <a class="dropdown-item edit_task" data-id="{{$post->id}}" data-title="{{$post->title}}" data-body="{{$post->body}}">Edit</a>
                                                </li>

                                                <li><button type="submit" class="dropdown-item" onclick="return confirm('Are you to delete?')">Delete</button></li>
                                            </form>
                                        </ul>
                                    </div>
                                    @endif
                                @endif
                            </div>


                            <h2 class="card-title">{{$post->title}}</h2>
                            <p class="card-text">{{substr($post->body,0,200)}}</p>
                            <a class="btn text-white" style="background-color: #836FFF" href="{{route('postdetail',$post->id)}}">Read more →</a>
                        </div>
                    </div>
                @endforeach
                {{$posts->links()}}


            </div>

        </div>
    </div>




  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="editForm" action="" method="POST">
                @csrf
                @method('put')

                <div class="mb-3">

                    <input type="text" id="editTitle" name="title" class="form-control @error('title')is-invalid @enderror" id="title" value="{{old('title') ?? $post->title}}">
                    @error('title')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">

                    <textarea class="form-control" id="editBody" name="body" id="body" rows="3" >{{old('body')??$post->body}}</textarea>
                  </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

      </div>
    </div>
  </div>
@endsection
@section('edit')
    <script>
        //task edit

$('.edit_task').click(function(){

$id =$(this).data('id');
$title=$(this).data('title');
$body=$(this).data('body');
$('#editTitle').val($title);
$('#editBody').val($body);
$('#editForm').attr('action', '{{ url("posts") }}/' + $id);
$('#editModal').modal('show');
})
    </script>
@endsection
