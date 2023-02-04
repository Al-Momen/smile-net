<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smile Net</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- fontawesome css link -->
    <link rel="stylesheet" href="{{URL::asset('assets/frontend/css/all.min.css')}}">
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="{{URL::asset('assets/frontend/css/bootstrap.min.css')}}">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ getImage(imagePath()['logoIcon']['path'] .'/favicon.png') }}" type="image/x-icon">
    <!-- odometer css -->
    <link rel="stylesheet" href="{{URL::asset('assets/frontend/css/odometer.css')}}">
    <!-- lightcase css links -->
    <link rel="stylesheet" href="{{URL::asset('assets/frontend/css/lightcase.css')}}">
    <!-- chosen css -->
    <link rel="stylesheet" href="{{URL::asset('assets/frontend/css/chosen.css')}}">
    <!-- swipper css link -->
    <link rel="stylesheet" href="{{URL::asset('assets/frontend/css/swiper.min.css')}}">
    <!-- apex-chart css link -->
    <link rel="stylesheet" href="{{URL::asset('assets/frontend/css/apexcharts.css')}}">
    <!-- line-awesome-icon css -->
    <link rel="stylesheet" href="{{URL::asset('assets/frontend/css/line-awesome.min.css')}}">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{URL::asset('assets/frontend/css/animate.css')}}">
    <!-- main style css link -->
    <link rel="stylesheet" href="{{URL::asset('assets/frontend/css/style.css')}}">
    <!-- animate.css link cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
      
    @stack('css')
    @stack('meta')
</head>

<body>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Page-wrapper
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="page-wrapper">
        @include("frontend.deshboard.partials.sidebar")
        <div class="main-wrapper">
            <div class="main-body-wrapper">
                <!-- navbar-wrapper-start -->
                @include("frontend.deshboard.partials.navbar")
                <!-- body-wrapper-start -->
                <div class="body-wrapper">
                    <div class="dashboard-area">
                        <div class="dashboard-item-area">
                            <div class="row mb-20-none overflow-hidden">
                            </div>
                        </div>
                    </div>

                    @yield('content')
                    
                </div>
            </div>
        </div>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Page-wrapper
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Bottom-nav
~   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="bottom-nav">
        <a href="{{route('user.buying.plan.ticket.view')}}">
            <i class="las la-credit-card"></i>
            <p>Plan</p>
        </a>
        <a href="{{route('user.events')}}">
            <i class="las fa-solid fa-box"></i>
            <p>Events</p>
        </a>
        <a href="{{route('user.deshboard')}}" class="mid">
            <i class="las la-home"></i>
            <p>Dashboard</p>
        </a>
        <a href="{{route('user.books')}}">
            <i class="las fa-solid fa-book"></i>
            <p>Book</p>
        </a>
        <a href="{{route('user.profile')}}">
            <i class="las la-user"></i>
            <p>Account</p>
        </a>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Bottom-nav
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!-- jquery -->
    
    <script src="{{URL::asset('assets/frontend/js/jquery-3.3.1.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{URL::asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
    <!-- swipper js -->
    <script src="{{URL::asset('assets/frontend/js/swiper.min.js')}}"></script>
    <!-- country js -->
    <script src="{{URL::asset('assets/frontend/js/countrypicker.min.js')}}"></script>
    <!-- viewport js -->
    <script src="{{URL::asset('assets/frontend/js/viewport.jquery.js')}}"></script>
    <!-- odometer js -->
    <script src="{{URL::asset('assets/frontend/js/odometer.min.js')}}"></script>
    <!-- lightcase js-->
    <script src="{{URL::asset('assets/frontend/js/lightcase.js')}}"></script>
    <!-- chosen js -->
    <script src="{{URL::asset('assets/frontend/js/chosen.jquery.js')}}"></script>
    <!-- appex-chart js -->
    <script src="{{URL::asset('assets/frontend/js/apexcharts.js')}}"></script>
    <!-- wow js file -->
    <script src="{{URL::asset('assets/frontend/js/wow.min.js')}}"></script>
    <!-- main -->
    <script src="{{URL::asset('assets/frontend/js/script.js')}}"></script>
    <script src="{{URL::asset('assets/frontend/js/popper.js')}}"></script>
    {{-- tosat js --}}
    <!-- country js -->
    <script src="{{URL::asset('assets/frontend/js/countrypicker.min.js')}}"></script>
    
    @include('partials.notify')
    @stack('js')

</body>

</html>