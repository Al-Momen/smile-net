@extends('frontend.deshboard.master')
@section('content')

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                Start Forgot Section
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
                <h3 class="mb-3 text-white fs-2 px-3">Password Change</h3>
                <div class="shadow-lg rounded">
                    <div class="pe-0">
                        <div class="form-left h-100 py-5 px-5 text-white">
                            <form class="row g-4" action="{{ route('user.password.change.store') }}" method="post">
                                @csrf
                                <div class="col-12">
                                    <div class="form-check d-none p-0">
                                        <input type="text" name="profile_id" value="{{$profile->id}}"class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check p-0">
                                        <label class="mb-3 text-white">Old Password<span class="text-danger">*</span></label>
                                        <input type="text" name="old_pass" placeholder="Old Password"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check p-0">
                                        <label class="mb-3 text-white">New Password<span class="text-danger">*</span></label>
                                        <input type="text" name="new_pass" placeholder="New Password"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check p-0">
                                        <label class="mb-3 text-white">Confirm Password<span class="text-danger">*</span></label>
                                        <input type="text" name="confirm_pass" placeholder="Confirm Password"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                   <div>
                                    <button type="submit" class="btn btn-primary px-4 w-100 mt-4">Submit</button>
                                   </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                End forgot Section
            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection

@push('js')
    {{-- toastr --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}")
        @endif
    </script>
@endpush
