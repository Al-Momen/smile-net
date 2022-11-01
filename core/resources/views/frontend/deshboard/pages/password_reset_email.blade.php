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
                        <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close"
                            data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>{{ session('info') }}!</strong> <button type="button" class="btn-close"
                            data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <div class="shadow-lg p-4 card-1">
                <form action="{{route('user.password.reset.email')}}"  method="post" class="form-dashboard">
                    @csrf
                    <div class="row justify-content-center mb-20-none">
                        <div class="col-xl-12 form-group mb-20">
                            <label class="mb-3 text-white">Email*</label>
                            <input type="text" name="email" placeholder="Enter your Email" class="form-control">
                        </div>
                        <div class="col-xl-12 form-group mb-20">
                            <button type="submit" class="btn btn-primary rounded mt-4">
                                Submit</button>
                        </div>
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
