@extends('backend.layouts.app')

@section('content')
    @section('header')
        <x-page-header header="Edit Admins"/>
    @endsection

    <div class="container">
        <div class="mb-2 flex justify-end">
            <a href="{{ route('admins-management.index') }}" class="btn bg-gradient-gray">
                <i class="fa-solid fa-arrow-left-long"></i>
                Back
            </a>
        </div>
        <div class="card bg-gradient-gray">
            <div class="card-body">
                <form action="{{ route('admins-management.update', $admins_management->id) }}" method="POST"
                      enctype="multipart/form-data"
                      autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $admins_management->name }}"
                                       autofocus>
                            </div>
                        </div>
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" value="{{ $admins_management->email }}">
                            </div>
                        </div>
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        @error('password')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="col">
                            <div class="mb-3">
                                <label for="file" class="form-label">Profile</label>
                                <input type="file" class="form-control" name="profile_img">
                            </div>
                        </div>
                        @error('profile_img')
                        <small class="text-danger">{{$message}}</small>
                        @enderror

                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn bg-gradient-gray">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
