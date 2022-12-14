<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Header Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <header class="header-section">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand header-logo" href="index.html"><img src="{{URL::asset("assets/frontend/images/logo/logo1.png")}}" alt="logo"
                        srcset=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item pe-1">
                            <a class="nav-link text-white fs-6 nav-text" aria-current="page" href="{{route('user.index')}}">Home</a>
                        </li>
                        <li class="nav-item pe-1">
                            <a class="nav-link text-white fs-6" href="{{route('user.pricing')}}">Pricing</a>
                            
                            
                        </li>
                        <li class="nav-item dropdown pe-1">
                            <a class="nav-link text-white dropdown-toggle fs-6" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tickets
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-white text-capitalize fs-6" href="ticket.html">Sport
                                        Tickets</a>
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
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item pe-1">
                            <a class="nav-link text-white fs-6" href="{{route('user.voting')}}">Voting</a>
                        </li>
                        <li class="nav-item pe-1">
                            <a class="nav-link text-white fs-6" href="{{route('user.magazine')}}">Magazine</a>
                        </li>
                        <li class="nav-item pe-1">
                            <a class="nav-link text-white fs-6" href="{{route('user.live_now')}}">Live Now</a>
                        </li>
                        <li class="nav-item pe-1">
                            <a class="nav-link text-white fs-6" href="{{route('user.music')}}">Music</a>
                        </li>
                        <li class="nav-item pe-1">
                            <a class="nav-link text-white fs-6" href="{{route('user.smile_tv')}}">Smile TV</a>
                        </li>
                        <li class="nav-item pe-1">
                            <a class="nav-link text-white fs-6" href="{{route('user.news')}}">News</a>
                        </li>
                    </ul>
                    <select class="my-select selectpicker me-3" data-container="body">
                        <option>Eng</option>
                        <option>Esp</option>
                    </select>
                    <a href="{{route('user.login.form')}}">
                        <button class="btn btn-danger" type="submit">Sign In</button>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Header Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->