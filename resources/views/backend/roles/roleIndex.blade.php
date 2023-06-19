@extends('backend.layouts.master')
@section('main_content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card-style mb-30">
                <div class="mb-20">
                    <h6 class="mb-10">Role List</h6>
                    <p class="text-sm mb-20">
                        For basic styling—light padding and only horizontal
                        dividers—use the class table.
                    </p>
                </div>
                <div class="table-wrapper table-responsive text-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    <h6>Name</h6>
                                </th>
                                <th>
                                    <h6>Action</h6>
                                </th>
                            </tr>
                            <!-- end table row-->
                        </thead>
                        <tbody>
                            @forelse ($allRole as $role)
                                <tr>
                                    <td>
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td class="min-width">
                                        <p>{{ $role->name }}</p>
                                    </td>
                                    <td>
                                        <div class="action justify-content-center">
                                            <a href="{{ route('admin.role.show', $role->id) }}" class="p-2 text-info">
                                                <i class="lni lni-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.role.delete', $role->id) }}" class="p-2 text-danger"
                                                onclick="event.preventDefault();document.querySelector('#roleDeleteForm').submit()">
                                                <i class="lni lni-trash-can"></i>
                                            </a>
                                            <form id="roleDeleteForm" action="{{ route('admin.role.delete', $role->id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <!-- end table row -->
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="alert-box danger-alert">
                                            <div class="alert">
                                                <h4 class="alert-heading">No Role Found!</h4>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- end table -->
                </div>

            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-lg-5">
            <div class="card-style">
                <div class="mb-20">
                    <h6 class="mb-10">Create New Role</h6>
                    <p class="text-sm mb-20">
                        For basic styling—light padding and only horizontal
                        dividers—use the class table.
                    </p>
                </div>
                <form class="row" action="{{ route('admin.role.store') }}" method="POST">
                    @csrf
                    <div class="col-lg-12">
                        <div class="input-style-3">
                            <input type="text" name="name" placeholder="Enter Roll Name">
                            <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                        </div>
                    </div>
                    {{-- <div class="col-lg-12">
                        <div class="form-check form-switch my-2">
                            <input type="checkbox" class="form-check-input" role="switch" id="cbx_select_all">
                            <label for="cbx_select_all" class="form-check-label text-capitalize">All Permission</label>
                        </div>
                        <div class="row">
                            @foreach ($allPermission as $permission_group_name => $permission_group)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input cbx_group" type="checkbox" role="switch"
                                                    id="cbx_group_{{ $permission_group_name }}"
                                                    value="{{ $permission_group_name }}">
                                                <label class="form-check-label text-capitalize"
                                                    for="cbx_group_{{ $permission_group_name }}">
                                                    {{ $permission_group_name }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($permission_group as $permission)
                                                <div class="form-check form-switch">
                                                    <input
                                                        class="form-check-input cbx_item cbx_group_{{ $permission_group_name }}"
                                                        type="checkbox" role="switch"
                                                        id="{{ $permission_group_name . $permission->id }}"
                                                        data-group="{{ $permission_group_name }}" name="permissions[]"
                                                        value="{{ $permission->id }}">
                                                    <label class="form-check-label"
                                                        for="{{ $permission_group_name . $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}
                    <div class="col-lg-12">
                        <button type="submit" class="w-100 btn-sm main-btn primary-btn rounded-md btn-hover">
                            Add New Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
