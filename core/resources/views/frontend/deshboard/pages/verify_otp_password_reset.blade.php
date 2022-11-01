@extends('frontend.deshboard.master')
@section('content')
    <!-- body-wrapper-start -->
    <div class="body-wrapper">
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
            @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>{{ session('info') }}!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            <div class="shadow-lg p-4 card-1">
                <form class="row g-4" action="{{ route('user.password.reset.OTP.check') }}" method="post">
                    @csrf
                    <div class="col-12">
                        <label class="text-white">OTP Code<span class="text-danger">*</span></label>
                        <div class="input-group d-none">
                            <input type="text" name="id" class="form-control">
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
