@extends('layouts.app')

@section('title')
    Edit user
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0 pb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{route("update", $user->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("put")
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mb-4">Edit user</h3>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mobile_number" class="form-label">Mobile Number</label>
                                        <input type="text" name="mobile_number" class="form-control" id="mobile_number"
                                               minlength="10" maxlength="10" value="{{$user->mobile_number}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="profile" class="form-label">Profile Picture</label>
                                        <input type="file" name="profile" class="form-control" accept=".jpeg, .jpg, .png"
                                               id="profile">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="text-end">
                                        <button class="btn btn-primary">Update now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
