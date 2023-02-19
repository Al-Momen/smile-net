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

                <h3 class="mb-3 text-white fs-2 px-3">Sign In</h3>
                <div class="shadow-lg rounded">
                    <div class="pe-0">
                        <div class="form-left h-100 py-5 px-5 text-white">
                            <form class="row g-4" action="{{ route('login.action') }}" method="post">
                                @csrf
                                <div class="col-12">
                                    <label class="text-white">Email<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="text-white">Password<span class="text-danger">*</span></label>
                                    <div class="">
                                        <input id="password-field" type="password" name="password" class="form-control" placeholder="Password">
                                        <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        {{-- <input class="form-check-input p-1" type="checkbox" name="remember" id="inlineFormCheck">
                                        <label class="form-check-label text-white" for="inlineFormCheck">Remember
                                            me</label> --}}
                                        <a href="{{ route('password.reset.email.view') }}">Forgot password?</a>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4 float-end mt-4">Sign
                                        In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <a href="{{ route('registration') }}" class="d-flex justify-content-center">
                        <h3 class="text-capitalize text-danger fs-6 pb-3">create an account</h3>
                    </a>
                </div>
            </div>

        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            End SignIn Section
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection
@push('js')
    <script>
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
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
