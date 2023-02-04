<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.seo')
    <title>{{$general->sitename}}</title>

    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css') }}">
    <!-- fontawesome css link -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontawesome-all.min.css') }}">
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <!-- lightcase css links -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lightcase.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.css') }}">
    <!-- swipper css link -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/swiper.min.css') }}">

    <!-- favicon -->
    {{-- <link rel="icon" href="{{asset('images/logoIcon/favicon.png') }}" type="image/x-icon"> --}}
    @stack('css')
</head>

<body>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Scroll-To-Top Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
   


    
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Scroll-To-Top Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <button type="button" class="btn btn-outline-danger btn-floating btn-lg rounded-circle" id="btn-to-top">
        <i class="fas fa-arrow-up scroll-top"></i>
    </button>

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Header Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    @include('frontend.partials.navbar')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Header Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
   
    @yield('content');


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Footer Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    @include('frontend.partials.footer')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Footer Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!-- Modal Video-->
    <div class="modal modal-2 fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <video id="player" class="video-player" playsinline controls data-poster="">
                        <source src="http://localhost/smile-net/core/storage/app/public/top-movies/movies/2022-10-31-1667203379.mkv" type="video/mp4" />
                    </video>
                </div>
            </div>
        </div>
    </div>



    <!-- jquery js -->
    <script src="{{asset('assets/frontend/js/jquery-3.3.1.min.js')}}"></script>

    <script src="{{asset('assets/frontend/js/jquery.nice-select.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
    <!-- swipper js -->
    <script src="{{asset('assets/frontend/js/swiper.min.js')}}"></script>
    <!-- Music -->
    <script src="{{asset('assets/frontend/js/music.js')}}"></script>
    <!-- chosen -->
    <script src="{{asset('assets/frontend/js/lightcase.js')}}"></script>
    <!-- chosen -->
    <script src="{{asset('assets/frontend/js/chosen.jquery.js')}}"></script>
    <!-- moment -->
    <script src="{{asset('assets/frontend/js/moment.min.js')}}"></script>
    <!-- script -->
    <script src="{{asset('assets/frontend/js/script.js')}}"></script>
    <!-- country js -->
    <script src="{{URL::asset('assets/frontend/js/countrypicker.min.js')}}"></script>


    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: false,
            direction: 'horizontal',
            scrollbar: { el: '.swiper-scrollbar' },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            breakpoints: {
                '480': {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                '768': {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                '820': {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                '912': {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
            },
        });

        var swiper2 = new Swiper(".mySwiper2", {
            slidesPerView: 4,
            spaceBetween: 20,
            freeMode: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false
            },
            breakpoints: {
                '480': {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                '768': {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                '820': {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                '912': {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
            },
        });

        var swiper = new Swiper(".mySwiper3", {
            direction: 'horizontal',
            scrollbar: { el: '.swiper-scrollbar' },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            }
        });

        var swiper = new Swiper(".mySwiper4", {
            slidesPerView: 4,
            spaceBetween: 30,
            // autoplay: {
            //     delay: 6000,
            //     disableOnInteraction: false
            // },
            breakpoints: {
                1199: {
                slidesPerView: 3,
                },
                991: {
                slidesPerView: 2,
                },
                767: {
                slidesPerView: 2,
                },
                575: {
                slidesPerView: 1,
                },
                320: {
                slidesPerView: 1,
                },
            }
        });

        var swiper = new Swiper(".card-slider", {
            slidesPerView: 4,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                speed: 1000,
                delay: 3000,
            },
            speed: 1000,
            breakpoints: {
                1199: {
                slidesPerView: 4,
                },
                991: {
                slidesPerView: 3,
                },
                767: {
                slidesPerView: 2,
                },
                575: {
                slidesPerView: 1,
                },
            }
        });

        var swiper = new Swiper(".mySwiper5", {
            slidesPerView: 4,
            spaceBetween: 30,
            freeMode: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false
            },
            breakpoints: {
                '480': {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                '768': {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                '820': {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                '912': {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
            },
        });
    </script>
    @include('partials.plugins')
    @include('partials.notify')
    @stack('js')
</body>

</html>