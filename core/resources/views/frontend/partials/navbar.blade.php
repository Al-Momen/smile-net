<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Header Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<header class="header-section">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand header-logo" href="index.html"><img
                    src="{{ asset('assets/frontend/images/logo/logo1.png') }}" alt="logo" srcset=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item pe-1">
                        <a class="nav-link text-white fs-6 nav-text" aria-current="page"
                            href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item pe-1">
                        <a class="nav-link text-white fs-6" href="{{ route('pricing') }}">Pricing</a>


                    </li>
                    <li class="nav-item dropdown pe-1">
                        <a class="nav-link text-white dropdown-toggle fs-6" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Events
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">


                            @foreach ($category_events as $category_event)
                                <li><a class="dropdown-item text-white text-capitalize fs-6"
                                        href="ticket.html">{{ $category_event->name }}</a>
                                </li>
                            @endforeach
                            {{-- <li><a class="dropdown-item text-white text-capitalize fs-6" href="{{route('event')}}">
                                        Movies Events</a>
                                </li>
                                <li><a class="dropdown-item text-white text-capitalize fs-6"
                                        href="ticket.html">Conference Ticket</a>
                                </li>
                                <li><a class="dropdown-item text-white text-capitalize fs-6" href="ticket.html">Concert
                                        Tickets</a>
                                </li>
                                <li><a class="dropdown-item text-white text-capitalize fs-6"
                                        href="ticket.html">Christian Events Tickets</a>
                                </li>
                                <li><a class="dropdown-item text-white text-capitalize fs-6" href="ticket.html">Bus
                                        Ticket</a>
                                </li>
                                <li><a class="dropdown-item text-white text-capitalize fs-6" href="ticket.html"> Flights
                                        tickets</a>
                                </li> --}}
                        </ul>
                    </li>
                    <li class="nav-item pe-1">
                        <a class="nav-link text-white fs-6" href="{{ route('voting') }}">Voting</a>
                    </li>
                    <li class="nav-item pe-1">
                        <a class="nav-link text-white fs-6" href="{{ route('magazine') }}">Magazine</a>
                    </li>
                    <li class="nav-item pe-1">
                        <a class="nav-link text-white fs-6" href="{{ route('live_now') }}">Live Now</a>
                    </li>
                    <li class="nav-item pe-1">
                        <a class="nav-link text-white fs-6" href="{{ route('music') }}">Music</a>
                    </li>
                    <li class="nav-item pe-1">
                        <a class="nav-link text-white fs-6" href="{{ route('smile_tv') }}">Smile TV</a>
                    </li>
                    <li class="nav-item pe-1">
                        <a class="nav-link text-white fs-6" href="{{ route('news') }}">News</a>
                    </li>
                </ul>
                <select class="my-select selectpicker me-3" data-container="body">
                    <option>Eng</option>
                    <option>Esp</option>
                </select>
                <a href="{{ url('login') }}">
                    <button class="btn btn-danger" type="submit">Sign In</button>
                </a>
            </div>
        </div>
    </nav>
</header>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Header Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
