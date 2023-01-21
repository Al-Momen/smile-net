{{-- @extends('frontend.deshboard.master')
@section('content')
    <!-- body-wrapper-start -->

    <div class="table-content">
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
                <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('danger') }}!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
        <div class="shadow-lg p-4 card-1">

            <form class="row g-4" action="{{ route('password.reset.OTP.check') }}" method="post">
                @csrf
                <div class="col-12">
                    <label class="text-white">OTP Code<span class="text-danger">*</span></label>
                    <div class="input-group d-none">
                        <input type="text" name="id" value="{{$profileId}}" class="form-control">
                    </div>
                    <div class="input-group">
                        <input type="text" name="verified_code" class="form-control" placeholder="Code">
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary px-4 float-end mt-4">Send</button>
                </div>
            </form>
        </div>
    </div>
@endsection --}}




@extends('frontend.master')
@section('content')

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            Start verify OTP Section
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
                @if (session('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('danger') }}!</strong> <button type="button" class="btn-close"
                            data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h3 class="mb-3 text-white fs-2 px-3">Verification Code</h3>
                <div class="shadow-lg rounded">
                    <div class="pe-0">
                        <div class="form-left h-100 py-5 px-5 text-white">
                            <form class="row g-4" action="{{ route('password.reset.OTP.check') }}" method="post">
                                @csrf
                                <div class="col-12">
                                    <div class="input-group d-none">
                                        <input type="text" name="id" value="{{$profileId}}" class="form-control">
                                    </div>

                                    <div class="form-check p-0">
                                        <label class="mb-3 text-white"> OTP Code<span class="text-danger">*</span></label>
                                        <input type="text" name="verified_code" class="form-control" placeholder="Code">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4 w-100 mt-4">Verify</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            End verify OTP Section
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection

