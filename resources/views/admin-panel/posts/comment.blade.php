@extends('layouts.admin')
@section('title','Post Index')
@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Comments</h1>
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/posts')}}" class="text-decoration-none">Posts</a></li>
                <li class="breadcrumb-item active">comments</li>
            </ol>

        </div>



        @if(Session('successMsg'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session('successMsg')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        @endif


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Comments List
            </div>
            <div class="card-body">
                <table id="" class="table table-bordered table-hover">

                    <tbody>
                        @if($comments->count() < 1)
                            No Comment
                        @else
                            @foreach($comments as $comment)
                            <tr>

                                <td>{{$comment->text}}</td>

                                <td>
                                    <form action="{{url('admin/comments/'.$comment->id.'/show_hide')}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm
                                            {{($comment->status=='show')? 'btn-danger' : 'btn-success'}}
                                            ">
                                            {{($comment->status=='show')? 'Hide' : 'Show'}}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @endif


                    </tbody>
                </table>
                {{-- {{$categories->links()}} --}}
            </div>
        </div>
    </div>
</main>

@endsection
