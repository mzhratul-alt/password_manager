@extends('backend.layouts.master')
@section('main_content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <div>
                        <h6 class="mb-10">Role Edit</h6>
                        <p class="text-sm mb-20">
                            For basic styling—light padding and only horizontal
                            dividers—use the class table.
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('admin.role.index') }}" class="px-5 btn-sm main-btn warning-btn rounded-md btn-hover">
                            View All Role
                        </a>
                        <button type="submit" onclick="$('#role_permission_update_form').submit()" class="px-5 btn-sm main-btn primary-btn rounded-md btn-hover">
                            Update Role
                        </button>
                    </div>
                </div>

                <form id="role_permission_update_form" class="row" action="{{ route('admin.role.update', $role->id) }}" method="POST">
                    @csrf
                    <div class="col-lg-12">
                        <div class="input-style-3">
                            <input type="text" name="name" value="{{ $role->name }}" placeholder="Enter Roll Name">
                            <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
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
                                                        value="{{ $permission->id }}"
                                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
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
                    </div>
                </form>

            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
@push('child_scripts')
    <script>
        $(function() {
            //Select All cbx
            $("#cbx_select_all").on("change", function() {
                if ($("#cbx_select_all").is(":checked")) {
                    $(".cbx_item, .cbx_group").prop("checked", true);
                } else {
                    $(".cbx_item, .cbx_group").prop("checked", false);
                }
            });

            //Select Group cbx
            $(".cbx_group").on("change", function() {
                var groupName = $(this).val();

                if ($("#cbx_group_" + groupName).is(":checked")) {
                    $(".cbx_group_" + groupName).prop("checked", true);
                } else {
                    $(".cbx_group_" + groupName).prop("checked", false);
                }

                checkAllState();
            });

            // Select cbx Item

            $(".cbx_item").on("change", function() {
                var groupName = $(this).data("group");
                var total_group_cbx = $(".cbx_group_" + groupName).length;
                var total_selected_group_cbx = $(
                    ".cbx_group_" + groupName + ":checked"
                ).length;

                if (total_group_cbx == total_selected_group_cbx) {
                    $("#cbx_group_" + groupName).prop("checked", true);
                } else {
                    $("#cbx_group_" + groupName).prop("checked", false);
                }

                checkAllState();
            });

            function checkAllState() {
                var all_cbx = $(".cbx_item").length + $(".cbx_group").length,
                    all_selected_cbx =
                    $(".cbx_item:checked").length + $(".cbx_group:checked").length;
                if (all_cbx == all_selected_cbx) {
                    $("#cbx_select_all").prop("checked", true);
                } else {
                    $("#cbx_select_all").prop("checked", false);
                }
            }

            $(window).on("load", function() {
                $(".cbx_item").each(function() {
                    var groupName = $(this).data("group");
                    var total_group_cbx = $(".cbx_group_" + groupName).length;
                    var total_selected_group_cbx = $(
                        ".cbx_group_" + groupName + ":checked"
                    ).length;

                    if (total_group_cbx == total_selected_group_cbx) {
                        $("#cbx_group_" + groupName).prop("checked", true);
                    } else {
                        $("#cbx_group_" + groupName).prop("checked", false);
                    }
                });
                checkAllState();
            });
        })
    </script>
@endpush
