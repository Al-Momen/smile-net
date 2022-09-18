<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smile Net</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/style.css') }}">
    <!-- fontawesome css link -->
    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/fontawesome-all.min.css') }}">
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/bootstrap.min.css') }}">
    <!-- lightcase css links -->
    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/lightcase.css') }}">
    <!-- swipper css link -->
    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/swiper.min.css') }}">
    <!-- favicon -->
    <link rel="icon" href="{{ URL::asset(imagePath()['logoIcon']['path'] . '/' . 'favicon.png') }}" type="image/x-icon">
</head>

<body>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Scroll-To-Top Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <button type="button" class="btn btn-outline-danger btn-floating btn-lg rounded-circle" id="btn-to-top">
        <i class="fas fa-arrow-up scroll-top"></i>
    </button>


    
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
                        <source src="{{URL::asset('assets/frontend/video/video.mp4')}}" type="video/mp4" />
                    </video>
                </div>
            </div>
        </div>
    </div>



    <!-- bootstrap js -->
    <script src="{{ URL::asset('assets/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/frontend/js/bootstrap.min.js')}}"></script>
    <!-- swipper js -->
    <script src="{{URL::asset('assets/frontend/js/swiper.min.js')}}"></script>
    <!-- lightcase js-->
    <script src="{{URL::asset('assets/frontend/js/lightcase.js')}}"></script>
    <!-- script -->
    <script src="{{URL::asset('assets/frontend/js/script.js')}}"></script>


    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 30,
            loop: true,
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
                    slidesPerView: 3,
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

        var swiper2 = new Swiper(".mySwiper2", {
            slidesPerView: 3,
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
            slidesPerView: 3,
            spaceBetween: 40,
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
</body>

</html>