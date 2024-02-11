@extends('layouts.admin')
@section('title','User Edit')
@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">User</h1>
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/users')}}" class="text-decoration-none">Users</a></li>
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
            <a href="{{url('admin/users')}}" class="btn btn-danger btn-sm my-3"><i class="fa-solid fa-angles-left"></i>Back</a>
        </div>



        @if(Session('successMsg'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session('successMsg')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        @endif


        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-pen-to-square"></i>
                Edit User Form
            </div>

            <div class="card-body">
                <form action="{{route('users.update',$user->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" name="name" value="{{$user->name}}" class="form-control @error('name')is-invalid @enderror" id="name" aria-describedby="emailHelp">
                      @error('name')
                        <span class="invalid-feedback">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control @error('email')is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('email')
                        <span class="invalid-feedback">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Role</label>
                      <select name="role" id="" class="form-select">
                        <option value="">Select role</option>
                        <option value="admin"
                        @if($user->role == 'admin') selected @endif>
                            Admin
                        </option>
                        <option value="user"
                        @if($user->role == 'user') selected @endif>
                            User
                        </option>
                      </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>

            </div>
        </div>
    </div>
</main>

@endsection
