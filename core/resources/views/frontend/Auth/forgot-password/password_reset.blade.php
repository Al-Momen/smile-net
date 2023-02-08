@extends('frontend.master')
@section('content')

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                Start SignIn Section
            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <section>
        <div class="container mx-auto py-5">
            <div class="col-lg-8 offset-lg-1 mx-auto">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close"
                            data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <h3 class="mb-3 text-white fs-2 px-3">Reset Password</h3>
                <div class="shadow-lg rounded">
                    <div class="pe-0">
                        <div class="form-left h-100 py-5 px-5 text-white">
                            <form class="row g-4" action="{{ route('password.reset') }}" method="post">
                                @csrf
                                {{-- {{dd($profileId)}} --}}
                                <div class=" d-none col-xl-12 form-group mb-20">
                                    <input type="text" name="profile_id" class="form-control"
                                        value="{{ $profileId }}">
                                </div>

                                <div class="col-12">
                                    <label class="text-white">New Password*<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="new_pass" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="text-white">Confirm Password*<span class="text-danger">*</span></label>
                                    <div class="">
                                        <input type="password" id="password-field" name="confirm_pass" class="form-control">
                                        <span toggle="#password-field"
                                            class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4 float-end mt-4">Reset
                                        Password</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                End SignIn Section
            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection

@push('js')
    {{-- toastr --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}")
        @endif
    </script>
    <script>
        $(".toggle-password").click(function() {
            
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            console.log(input);
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endpush


@push('css')
    <style>
        .field-icon {
            float: right;
            margin-right: 15px;
            margin-top: -33px;
            position: relative;
            z-index: 2;
            cursor: pointer;
            color: black;

        }
    </style>
@endpush
