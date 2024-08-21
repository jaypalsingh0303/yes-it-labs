@extends('layouts.app')

@section('title')
    User lists
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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

                        @if(session()->has("success"))
                            <div class="alert alert-success mb-4">
                                <ul class="mb-0 pb-0">
                                    <li>{{ session()->get("success") }}</li>
                                </ul>
                            </div>
                        @endif

                        @if(session()->has("error"))
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0 pb-0">
                                    <li>{{ session()->get("error") }}</li>
                                </ul>
                            </div>
                        @endif

                        <div class="d-flex justify-content-end">
                            <a href="{{route("download_csv")}}" class="btn btn-primary">Download CSV</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if($users && count($users) > 0)
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <img src="{{asset("storage/$user->profile")}}" width="40"
                                                         class="img-fluid" alt="{{$user->name}}">
                                                    <div>
                                                        {{$user->name}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->mobile_number}}</td>
                                            <td>
                                                <a href="{{route("edit", $user->id)}}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                   onclick="event.preventDefault(); document.getElementById('delete-{{$user->id}}').submit();">
                                                    <i class="fa fa-trash"></i>
                                                </a>

                                                <form action="{{ route('delete', $user->id) }}" method="POST"
                                                      id="delete-{{$user->id}}" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-danger text-center" colspan="5">No result found..</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
