<footer class="footer text-center text-lg-start text-white pt-5">
    <div class="">
        <div class="container text-center text-md-start pt-5">
            <div class="row pt-3 footer-link">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <img class="img-fluid" src="{{URL::asset('assets/frontend/images/logo/logo1.png')}}" alt="logo" style="height: 4rem;">
                    <p class="py-3">
                        {!!$footer->heading!!}
                    </p>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4 ">
                        Resources
                    </h6>
                    <p>
                        <a href="{{route('index')}}" class="text-reset">Home</a>
                    </p>
                    <p>
                        <a href="" class="text-reset">Movies</a>
                    </p>
                    <p>
                        <a href="{{route('news')}}" class="text-reset">Author Walls</a>
                    </p>
                </div>

                {{-- <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Legal
                    </h6>
                    <p>
                        <a href="#0" class="text-reset">Terms of Use</a>
                    </p>
                    <p>
                        <a href="#0" class="text-reset">Privacy Policy</a>
                    </p>
                    <p>
                        <a href="#0" class="text-reset">Security</a>
                    </p>
                </div> --}}

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Contact
                    </h6>
                    <p><i class="fas fa-home me-3"></i>{{$social_link->address}}</p>
                    <p><i class="fas fa-envelope me-3"></i>{{$social_link->email}}</p>
                    <p><i class="fas fa-phone me-3"></i> {{$social_link->phone}}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="d-flex justify-content-center justify-content-lg-between border-top p-4 container">
        <div class="me-5 d-none d-lg-block">
            <p>
                © {{$footer->title}} Copyright:
                <a class="text-reset fw-bold" href="{{route('index')}}">{{$general->sitename}}</a>
            </p>
        </div>

        <div>
            <a href="{{URL($social_link->fb_link)}}" class="me-4 text-reset text-decoration-none">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="{{URL($social_link->twitter_link)}}" class="me-4 text-reset text-decoration-none">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="{{URL($social_link->instragram_link)}}" class="me-4 text-reset text-decoration-none">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="{{URL($social_link->linkedin_link)}}" class="me-4 text-reset text-decoration-none">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>
    </div>
    <!-- Copyright -->
</footer>