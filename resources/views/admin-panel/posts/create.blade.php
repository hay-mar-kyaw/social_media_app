@extends('layouts.admin')
@section('title','Create Post')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Post</h1>
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/posts')}}" class="text-decoration-none">Posts</a></li>
                <li class="breadcrumb-item active">Create Post</li>
            </ol>
            <a href="{{url('admin/posts')}}" class="btn btn-danger btn-sm my-3"><i class="fa-solid fa-angles-left"></i>Back</a>
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
                Create Post Form
            </div>
            <div class="card-body">
                <form action="{{url('admin/posts')}}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control @error('title')is-invalid @enderror" id="title"  placeholder="Enter Title" value="{{old('title')}}">
                        @error('title')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="3" placeholder="Enter body...">{{old('body')}}</textarea>
                        @error('body')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
