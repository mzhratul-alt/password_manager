@extends('backend.layouts.master')
@section('main_content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card-style">
                <div class="card-image">
                    <a href="#0">
                        <img class="img-fluid"
                            src="https://mzhratul.github.io/plain-admin-dashboard/full/assets/images/cards/card-style-2/card-1.jpg"
                            alt="">
                    </a>
                </div>
                <div class="mt-25">
                    <form action="{{ route('admin.user.update-password') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <h6 class="mb-20">Change Password</h6>
                        @if (session('success'))
                            <p class="text-medium text-success">
                                {{ session('success') }}
                            </p>
                        @endif
                        <div class="input-style-3">
                            <input type="password" name="old_password" placeholder="Old Password">
                            <span class="icon"> <i class="lni lni-key"></i> </span>
                            @if (session('error'))
                                <p class="text-medium text-danger mt-2">
                                    {{ session('error') }}
                                </p>
                            @endif
                        </div>
                        <!-- end input -->
                        <div class="input-style-3">
                            <input type="password" name="new_password" placeholder="New Password">
                            <span class="icon"><i class="lni lni-key"></i></span>
                        </div>
                        <!-- end input -->
                        <button class="main-btn primary-btn btn-hover w-100" type="submit">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card-style">
                <div class="heading-two d-flex">
                    <h2>{{ Auth::user()->name }} </h2>
                    <small
                        class="ms-2 align-self-end text-small text-gray bg-gray-100">{{ Auth::user()->getRoleNames()->first() }}</small>
                </div>
            </div>
        </div>
    </div>
@endsection
