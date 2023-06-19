@extends('backend.layouts.master')

{{-- @section('main_content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div class="card-content">
                    <h4 class="mb-4">{{ $hash->name }} Information</h4>
                    <form class="row" action="{{ route('admin.hash.update') }}" method="POST">
                        @csrf
                        <div class="col-lg-12">
                            <div class="input-style-3">
                                <input type="text" name="name" placeholder="Enter Site Name" value="{{ $hash->name }}">
                                <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-style-3">
                                <input type="text" name="short_code" placeholder="Enter Short Code" value="{{ $hash->short_code }}">
                                <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-style-3">
                                <input type="date" name="creation_date" value="{{ $hash->creation_date }}">
                                <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-style-3 d-flex">
                                <input type="text" id="text_for_hash" readonly disabled
                                    placeholder="Text for Hash (Readonly)">
                                <button class="main-btn primary-btn rounded-md btn-hover ms-4" type="button"
                                    onclick="generate_pass()">
                                    <i class="lni lni-spinner-arrow"></i>
                                </button>
                                <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-style-3">
                                <input type="text" id="password_for_hash" placeholder="Hash Password"
                                    onkeyup="encrypt()">
                                <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-style-3">
                                <input type="text" id="generated_hash" name="hash" readonly
                                    placeholder="Hash (Readonly)" value="{{ $hash->hash }}">
                                <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-style-3">
                                <input type="text" name="remark" placeholder="Enter Remark" {{ $hash->remark }}>
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
    </div>
@endsection --}}

@section('main_content')
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <h4 class="mb-4">{{ $hash->name }} Information</h4>
            <a class="main-btn danger-btn rounded-md btn-hover mb-4" href="{{ url()->previous() }}">Back</a>
        </div>
        <div class="col-lg-4">
            <div class="card-style mb-30">
                <div class="card-content">
                    <h3 class="text-bold mb-10">Site Short Code</h3>
                    <h6 class="mb-10">{{ $hash->short_code }}</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-style mb-30">
                <div class="card-content">
                    <h3 class="text-bold mb-10">Site Creation Date</h3>
                    <h6 class="mb-10">{{ $hash->creation_date }}</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-style mb-30">
                <div class="card-content">
                    <h3 class="text-bold mb-10">Remark</h3>
                    <h6 class="mb-10">{{ $hash->remark }}</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div class="card-content">
                    <h3 class="text-bold mb-10">Site Hash</h3>
                    <div class="input-style-3">
                        <input type="password" id="generated_hash" name="hash" placeholder="Hash (Readonly)"
                            value="{{ Crypt::decryptString($hash->hash) }}" readonly disabled>
                        <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                    </div>
                    <div class="input-style-3 d-flex">
                        <input type="text" id="password_for_hash" placeholder="Hash Password">
                        <button class="main-btn primary-btn rounded-md btn-hover ms-4" type="button" onclick="decrypt()">
                            Copy
                        </button>
                        <span class="icon"><i class="lni lni-checkmark-circle"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('child_scripts')
    <script src="{{ asset('assets/js/crypto.js') }}"></script>
    <script>
        //Code for decrypt
        function decrypt() {
            var text = document.getElementById('generated_hash').value
            var pass = document.getElementById('password_for_hash').value

            if (text.trim() == '' || pass.trim() == '') {
                alert('Input you text & password.')
            } else {
                var decryptedBytes = CryptoJS.AES.decrypt(text, pass);
                var plaintext = decryptedBytes.toString(CryptoJS.enc.Utf8);

                navigator.clipboard.writeText(plaintext)
            }
        }
    </script>
@endpush
