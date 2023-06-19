@extends('backend.layouts.master');
@section('main_content')
    <div class="row">
        <div class="col-lg-12 card-style">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <div>
                    <h6 class="mb-10">Create New User</h6>
                    <p class="text-sm mb-20">
                        For basic styling—light padding and only horizontal
                        dividers—use the class table.
                    </p>
                </div>
                <a href="{{ route('admin.user.index') }}" class="btn-sm main-btn primary-btn rounded-md btn-hover">
                    View All User
                </a>
            </div>
            <form action="{{ route('admin.user.store') }}" method="POST" class="row">
                @csrf
                <div class="col-lg-6 mb-10">
                    <div class="input-style-3">
                        <input type="text" name="name" placeholder="Enter Your Full Name">
                        <span class="icon"><i class="lni lni-user"></i></span>
                    </div>
                </div>
                <!-- end input -->
                <div class="col-lg-6 mb-10">
                    <div class="input-style-3">
                        <input type="email" name="email" placeholder="Enter Your Email">
                        <span class="icon"><i class="lni lni-envelope"></i></span>
                    </div>
                </div>
                <!-- end input -->
                <div class="col-lg-6">
                    <div class="select-style-1">
                        <div class="select-position">
                            <select name="role">
                                <option @readonly(true)>Select Role</option>
                                @forelse ($allRole as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @empty
                                <option disabled class="text-danger">No Role Found!</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
                <!-- end input -->
                <div class="col-lg-12 mb-10">
                    <div class="input-style-3">
                        <input type="password" name="password" placeholder="Enter Your Password">
                        <span class="icon"><i class="lni lni-key"></i></span>
                    </div>
                </div>
                <!-- end input -->
                <div class="col-lg-12 mb-10">
                    <button class="w-100 main-btn primary-btn rounded-md btn-hover" type="submit">Add New User</button>
                </div>
                <!-- end input -->
            </form>
        </div>
    </div>
@endsection
