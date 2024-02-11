@extends('layouts.admin')
@section('title','User Index')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">User</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        @if(Session('successMsg'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session('successMsg')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        @endif

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Users List
            </div>
            <div class="card-body">
                <table id="" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach($users as $user)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>
                                <form action="{{url('admin/users/'.$user->id.'/delete')}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="{{url('admin/users/'.$user->id.'/edit')}}" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you to delete?')"><i class="fa-solid fa-trash"></i>&nbsp;Delete</button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection
