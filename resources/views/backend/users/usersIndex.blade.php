@extends('backend.layouts.master')
@section('main_content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <div>
                        <h6 class="mb-10">User List</h6>
                        <p class="text-sm mb-20">
                            For basic styling—light padding and only horizontal
                            dividers—use the class table.
                        </p>
                    </div>
                    <a href="{{ route('admin.user.create') }}" class="btn-sm main-btn primary-btn rounded-md btn-hover">
                        Add New User
                    </a>
                </div>
                @if (count($allUser) >= 1)
                    <div class="table-wrapper table-responsive text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        <h6>Pic & Name</h6>
                                    </th>
                                    <th>
                                        <h6>Email</h6>
                                    </th>
                                    <th>
                                        <h6>Role</h6>
                                    </th>
                                    <th>
                                        <h6>Status</h6>
                                    </th>
                                    <th>
                                        <h6>Action</h6>
                                    </th>
                                </tr>
                                <!-- end table row-->
                            </thead>
                            <tbody>
                                @foreach ($allUser as $user)
                                    <tr>
                                        <td>
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td class="min-width">
                                            <div class="lead">
                                                <div class="lead-image">
                                                    <img src="assets/images/lead/lead-1.png" alt="">
                                                </div>
                                                <div class="lead-text">
                                                    <p>{{ $user->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="min-width">
                                            <p><a href="#0">{{ $user->email }}</a></p>
                                        </td>
                                        <td class="min-width">
                                            <p>{{ ($user->getRoleNames()->first()) ? $user->getRoleNames()->first() : 'Role not assigned' }}</p>
                                        </td>
                                        <td class="min-width">
                                            <span class="status-btn success-btn">Active</span>
                                        </td>
                                        <td>
                                            <div class="action justify-content-center">
                                                <a href="#" class="p-2 text-info">
                                                    <i class="lni lni-eye"></i>
                                                </a>
                                                <a href="#" class="p-2 text-secondary">
                                                    <i class="lni lni-pencil-alt"></i>
                                                </a>
                                                <a href="#" class="p-2 text-danger">
                                                    <i class="lni lni-trash-can"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- end table row -->
                                @endforeach
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                @else
                    <div class="alert-box danger-alert">
                        <div class="alert">
                            <p class="text-medium">
                                No User Found!
                            </p>
                        </div>
                    </div>
                @endif

            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection
