@extends('frontend.deshboard.master')
@section('content')
<!-- body-wrapper-start -->
<div class="table-content">
    <div class="shadow-lg p-4 card-1 my-3">
        <div class="row g-5 d-flex justify-content-center">
            <div class="col-lg-4 col-md-12 col-12">
                <img class="img-fluid rounded d-block mx-auto"
                    src="{{URL::asset('assets/frontend/images/bookMagazine/user.jpg')}}" alt="" height="200" width="200">
                <div>
                    <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                        <p class="text-white m-0 fw-bold">Name:</p>
                        <p class="text-white m-0 ">Jhon Danals</p>
                    </div>
                    <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                        <p class="text-white m-0 fw-bold">Email:</p>
                        <p class="text-white m-0 ">JhonDanals@gmail.com</p>
                    </div>
                    <div class="d-flex justify-content-between mt-4 rounded-2 p-2 user-card">
                        <p class="text-white m-0 fw-bold">Follower</p>
                        <p class="text-white m-0 ">12k</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-12 pt-4">
                <form action="" class="form-dashboard">
                    <div class="row g-4k">
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="text1" class="form-label text-white">Name<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="text1"
                                placeholder="jhon danals">
                        </div>
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="text2" class="form-label text-white">Email<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="text2"
                                placeholder="JhonDanals@gmail.com">
                        </div>
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="username" class="form-label text-white">UserName<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username"
                                placeholder="jhon123">
                        </div>
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="phone" class="form-label text-white">Phone<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone"
                                placeholder="123 121 1212">
                        </div>
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label class="text-white">Country<span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-md mb-3"
                                style="padding: 12px 10px;" aria-label=".form-select-lg example">
                                <option selected>Canada</option>
                                <option value="1">Japan</option>
                                <option value="2">Germany</option>
                                <option value="3">Switzerland</option>
                            </select>
                        </div>
                        <div class="mb-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="date1" class="form-label text-white">Image<span
                                    class="text-danger">*</span></label>
                            <input type="file" class="form-control px-3 pt-2">
                        </div>
                        <div class="my-3 col-12">
                            <button class="btn btn-primary rounded btn w-25">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection