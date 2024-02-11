@extends('layouts.front-end')
@section('content')
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1 text-center">Welcome in Post Detail</h1><br>
                        <!-- Post title-->
                        <h3 class="fw-bolder mb-1">{{$post->title}}</h3>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on {{date('d M, Y',strtotime($post->created_at))}}</div>

                    </header>


                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">{{$post->body}}</p>

                    </section>
                </article>
                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            <!-- Comment form-->
                            <form method="POST" action="{{route('comments.store',$post->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="commentText">Comment:</label>
                                    <textarea class="form-control mb-2" id="commentText" name="text" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn text-white" style="background-color: #836FFF"><i class="far fa-paper-plane"></i></button>
                            </form>
                            <!-- Comments-->
                            <div class="mb-4">
                                @foreach ($comments as $comment)
                                    <br>
                                    <div class="ms-3">
                                        <div class="d-flex justify-content-between">
                                            <div class="fw-bold">
                                                <i class="far fa-paper-plane"></i>{{$comment->user->name}}
                                            </div>
                                                @if(Auth::check())
                                                    @if(Auth::user()->id === $post->user_id)
                                                        @if(Auth::user()->id === $comment->user_id)
                                                            <form action="{{url('post/comment/'.$comment->id.'/delete')}}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <a class="btn btn-sm btn-warning editComment" data-id={{$comment->id}} data-text={{$comment->text}}>Edit</a>
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you to delete?')">Delete</button>
                                                            </form>
                                                        @else
                                                            <form action="{{url('post/comment/'.$comment->id.'/delete')}}" method="POST">
                                                                @csrf
                                                                @method('delete')

                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you to delete?')">Delete</button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        @if(Auth::user()->id === $comment->user_id)
                                                            <form action="{{url('post/comment/'.$comment->id.'/delete')}}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <a class="btn btn-sm btn-warning editComment" data-id={{$comment->id}} data-text={{$comment->text}}>Edit</a>
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you to delete?')">Delete</button>
                                                            </form>
                                                        @endif

                                                    @endif

                                                @endif
                                        </div>
                                        <p>{{$comment->text}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


  <!-- Modal -->
  <div class="modal fade" id="editComment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="editCommentForm" action="" method="POST">
                @csrf
                @method('put')

                <div class="mb-3">
                    <textarea class="form-control" id="editText" name="text" rows="3" ></textarea>
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
@section('editComment')
    <script>
        $('.editComment').click(function(){

        $id =$(this).data('id');
        $text=$(this).data('text');

        $('#editText').val($text);
        $('#editCommentForm').attr('action', '{{ url("post/comment") }}/' + $id);
        $('#editComment').modal('show');
        })
    </script>
@endsection

