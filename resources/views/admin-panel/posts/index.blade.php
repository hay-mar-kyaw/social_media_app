@extends('layouts.admin')
@section('title','Post Index')
@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Post</h1>
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active">Posts</li>
            </ol>
            <a href="{{url('admin/posts/create')}}" class="btn btn-primary btn-sm my-3"><i class="fa-solid fa-plus"></i>Create New</a>
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
                Posts List
            </div>
            <div class="card-body">
                <table id="" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach($posts as $index=>$post)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$post->title}}</td>
                            <td><textarea class="form-control" readonly>{{$post->body}}</textarea></td>
                            <td>
                                <form action="{{url('admin/posts/'.$post->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="{{url('admin/posts/'.$post->id.'/edit')}}" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you to delete?')"><i class="fa-solid fa-trash"></i>&nbsp;Delete</button>
                                    <a href="{{url('admin/posts/'.$post->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-comments"></i>Comments</a>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$posts->links()}}
            </div>
        </div>
    </div>
</main>

@endsection
