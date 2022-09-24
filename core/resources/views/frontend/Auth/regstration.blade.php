@extends('frontend.master')
@section('content')

     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start SignIn Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section>
        <div class="container mx-auto py-5">
            <div class="col-lg-8 offset-lg-1 mx-auto">
                <h3 class="mb-3 text-white fs-2 px-3">Sign Up</h3>
                <div class="shadow-lg rounded">
                    <div class="pe-0">
                        <div class="form-left h-100 py-5 px-5 text-white">
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
                            <form class="row g-4" action="{{url('registration')}}" method="POST">
                                @csrf
                                <div class="col-12">
                                    <label class="text-white">Full Name<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="fullname" class="form-control" placeholder="Full Name">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="text-white">Email<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>

                                <div class="row pt-4 pe-0">
                                    <div class="col-lg-6 col-md-6 col-12 pe-0">
                                        <label class="text-white">Phone<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="phone" class="form-control" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 pe-0">
                                        <label class="text-white">Country<span class="text-danger">*</span></label>
                                        <select class="form-select form-select-md mb-3" style="padding: 12px 10px;"
                                            aria-label=".form-select-lg example" name="country">
                                            <option selected>Canada</option>
                                            <option value="1">Japan</option>
                                            <option value="2">Germany</option>
                                            <option value="3">Switzerland</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="text-white">Password<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="text-white">Confirm Password<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4 float-end mt-4">Sign
                                        Up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <a href="#" class="d-flex justify-content-center">
                        <h3 class="text-capitalize text-center text-danger fs-6 pb-3">already have an account?</h3>
                    </a>
                </div>
            </div>

        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End SignIn Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


@endsection