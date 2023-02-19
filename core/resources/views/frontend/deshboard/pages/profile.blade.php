@extends('frontend.deshboard.master')
@section('content')
    <!-- body-wrapper-start -->
    <div class="table-content">
        <div class="shadow-lg p-4 card-1 my-3">
            <div class="row g-5 d-flex justify-content-center">
                <div class="col-lg-4 col-md-12 col-12">
                    <img class="img-fluid rounded d-block mx-auto" src="{{ getImage(imagePath()['profile']['user']['path'].'/'.$profile->photo,imagePath()['profile']['user']['size'])}}" alt="Image" height="350"
                        width="300" style="border-radius: 166px !important;">
                    <div>
                        <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                            <p class="text-white m-0 fw-bold">Name:</p>
                            <p class="text-white m-0 text-capitalize">{{ $profile->full_name }}</p>
                        </div>
                        <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                            <p class="text-white m-0 fw-bold">Email:</p>
                            <p class="text-white m-0 ">{{ $profile->email }}</p>
                        </div>
                        <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                            <p class="text-white m-0 fw-bold">Active Plan:</p>
                            <p class="text-white m-0 text-capitalize">
                                {{ $ticketTypeDetails != null ? $ticketTypeDetails->ticket_type->name : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 pt-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-dashboard" action="{{ route('user.profile.update', $profile->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4k">
                            <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="text1" class="form-label text-white">Name<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="text1" placeholder="jhon danals"
                                    name="name" required value="{{ $profile->full_name }}">
                            </div>

                            <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="phone" class="form-label text-white">Phone<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" placeholder="123 121 1212"
                                    name="phone" required value="{{ $profile->phone ?? null }}">
                            </div>
                            <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label class="text-white">Country<span class="text-danger">*</span></label>
                                <select class=" selectpicker countrypicker form-select form-select-md mb-3"
                                    style="padding: 12px 10px;" aria-label=".form-select-lg example" name="country"
                                    data-live-search="true" data-default="{{ $profile->country }}" data-flag="true">
                                </select>
                            </div>
                            <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="date1" class="form-label text-white">Image<span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control px-3 pt-2" name="image" re quired
                                    accept="image/*">
                            </div>
                            <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="date1" class="form-label text-white">Facebook</label>
                                <input type="text" class="form-control px-3 pt-2" name="facebook"
                                    placeholder="Your facebook link" value="{{ $profile->facebook ?? null }}">
                            </div>
                            <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="date1" class="form-label text-white">Instagram</label>
                                <input type="text" class="form-control px-3 pt-2" name="instagram"
                                    placeholder="Your instagram link" value="{{ $profile->instagram ?? null }}">
                            </div>
                            <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="date1" class="form-label text-white">Twitter</label>
                                <input type="text" class="form-control px-3 pt-2" name="twitter"
                                    placeholder="Your twitter link" value="{{ $profile->twitter ?? null }}">
                            </div>
                            <div class="my-3 col-12">
                                <button class="btn btn-primary rounded btn w-100">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
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
