@extends('backend.layouts.master')
@section('main_content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card-style mb-30">
                <div class="mb-20 d-flex justify-content-between align-items-center">
                    <h6 class="mb-10">Hash List</h6>
                    <a class="btn-sm main-btn success-btn rounded-md btn-hover" href="{{ route('admin.hash.export') }}">Export</a>
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
                                    <h6>Short Code</h6>
                                </th>
                                <th>
                                    <h6>Action</h6>
                                </th>
                            </tr>
                            <!-- end table row-->
                        </thead>
                        <tbody>
                            @forelse ($allHash as $hash)
                                <tr>
                                    <td>
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td class="min-width">
                                        <p>{{ $hash->name }}</p>
                                    </td>
                                    <td class="min-width">
                                        <p>{{ $hash->short_code }}</p>
                                    </td>
                                    <td>
                                        <div class="action justify-content-center">
                                            <a href="{{ route('admin.hash.show', $hash->id) }}" class="p-2 text-info">
                                                <i class="lni lni-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.hash.delete', $hash->id) }}" class="p-2 text-danger"
                                                onclick="event.preventDefault();document.querySelector('#hashDeleteForm').submit()">
                                                <i class="lni lni-trash-can"></i>
                                            </a>
                                            <form id="hashDeleteForm" action="{{ route('admin.hash.delete', $hash->id) }}"
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
                                    <td colspan="4">
                                        <div class="alert-box danger-alert">
                                            <div class="alert">
                                                <h4 class="alert-heading">No Hash Found!</h4>
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
                    <h6 class="mb-10">Create New Hash</h6>
                </div>
                <form class="row" action="{{ route('admin.hash.store') }}" method="POST">
                    @csrf
                    <div class="col-lg-12">
                        <div class="input-style-3">
                            <input type="text" name="name" placeholder="Enter Site Name">
                            <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="input-style-3">
                            <input type="text" name="short_code" placeholder="Enter Short Code">
                            <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-style-3">
                            <input type="date" name="creation_date">
                            <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="input-style-3 d-flex">
                            <input type="text" id="text_for_hash" placeholder="Text for Hash" onkeyup="encrypt()">
                            <button class="main-btn primary-btn rounded-md btn-hover ms-4" type="button"
                                onclick="generate_pass()">
                                <i class="lni lni-spinner-arrow"></i>
                            </button>
                            <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-style-3">
                            <input type="text" id="password_for_hash" placeholder="Hash Password" onkeyup="encrypt()">
                            <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-style-3">
                            <input type="text" id="generated_hash" name="hash" readonly placeholder="Hash (Readonly)">
                            <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="input-style-3">
                            <input type="text" name="remark" placeholder="Enter Remark">
                            <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="w-100 btn-sm main-btn primary-btn rounded-md btn-hover">
                            Add New Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('child_scripts')
    <script src="{{ asset('assets/js/crypto.js') }}"></script>
    <script>
        //Text for hash
        function generate_pass() {
            var chars = '0123456789aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ!@$%^&*()_+?><:{[}]"'
            var charsLength = chars.length
            var passLength = 8
            var password = ''

            for (var i = 0; i < passLength; i++) {
                var randomNum = Math.floor(Math.random() * charsLength)
                password += chars.substring(randomNum, randomNum + 1)
            }
            document.getElementById('text_for_hash').value = password
        }

        //Code for encrypt
        function encrypt() {
            var text = document.getElementById('text_for_hash').value.trim()
            var pass = document.getElementById('password_for_hash').value.trim()
            var encryptedAES = CryptoJS.AES.encrypt(text, pass);
            document.getElementById('generated_hash').value = encryptedAES
        }
    </script>
@endpush
