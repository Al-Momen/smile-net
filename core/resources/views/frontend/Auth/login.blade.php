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
                            <form action="{{route('user.login')}}" method="post" class="row g-4">
                                @csrf
                                <div class="col-12">
                                    <label class="text-white">Email<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="text-white">Password<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input p-1" type="checkbox" name="remember" id="inlineFormCheck">
                                        <label class="form-check-label text-white" for="inlineFormCheck">Remember
                                            me</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4 float-end mt-4">Sign
                                        In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <a href="{{route('user.regstration.form')}}" class="d-flex justify-content-center">
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