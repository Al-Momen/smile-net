@extends('frontend.deshboard.master')
@section('content')
    <!-- body-wrapper-start -->

        <div class="table-content">
            <div class="shadow-lg p-4 card-1">
                <form action="{{route('user.password.reset', $profileId)}}"  method="post" class="form-dashboard">
                    @csrf
                    <div class="row justify-content-center mb-20-none">
                        <div class="col-xl-12 form-group mb-20">
                            <label class="mb-3 text-white">Current Password*</label>
                            <input type="text" name="current_pass" class="form-control">
                        </div>
                        <div class="col-xl-12 form-group mb-20">
                            <label class="mb-3 text-white">New Password*</label>
                            <input type="password" name="new_pass" class="form-control">
                        </div>
                        <div class="col-xl-12 form-group mb-20">
                            <label class="mb-3 text-white">Confirm Password*</label>
                            <input type="password" name="confirm_pass" class="form-control">
                        </div>
                        <div class="col-xl-12 form-group mb-20">
                            <button type="submit" class="btn btn-primary rounded mt-4">Reset
                                Now</button>
                        </div>
                    </div>
                </form>
            </div>

@endsection
@push('js')
    {{-- toastr --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}")
        @endif
    </script>
@endpush
