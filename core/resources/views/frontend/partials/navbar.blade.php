<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Header Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@php
    $standard = App\Models\TicketTypeDetails::where('ticket_slug', 'standard')->first();
    $premium = App\Models\TicketTypeDetails::where('ticket_slug', 'premium')->first();
@endphp



<header class="header-section">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand header-logo" href="{{ route('index') }}"><img
                    src="{{ asset(imagePath()['logoIcon']['path'].'/whiteLogo.png')}}" alt="logo" srcset=""></a>
            {{-- <a class="navbar-brand header-logo" href="{{ route('index') }}"><img
                    src="{{ asset('assets/frontend/images/logo/logo1.png') }}" alt="logo" srcset=""></a> --}}
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
                        <a class="nav-link text-white fs-6" href="{{ route('ticketTypePricing') }}">Pricing</a>


                    </li>
                    <li class="nav-item dropdown pe-1">
                        <a class="nav-link text-white dropdown-toggle fs-6" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Events
                        </a>
                        <ul class="dropdown-menu events" aria-labelledby="navbarDropdown">


                            @foreach ($category_events as $category_event)
                                <li><a class="dropdown-item text-white text-capitalize fs-6"
                                        href="{{ route('user.event', $category_event->name) }}">{{ $category_event->name }}</a>
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
                        <a class="nav-link text-white fs-6" href="{{ route('books') }}">Books</a>
                    </li>

                    <li class="nav-item pe-1">
                        <a class="nav-link text-white fs-6" href="{{ route('music') }}">Musics</a>
                    </li>

                    @if (Auth::guard('general')->user())
                        @php
                            $premium = App\Models\TicketTypeDetails::where('ticket_slug', 'premium')
                                ->where('user_id', Auth::guard('general')->user()->id)
                                ->where('status', 1)
                                ->first();
                            // dd($premium);
                        @endphp
                    @endif

                    {{-- @if ($premium != null)
                        <li class="nav-item pe-1">
                            <a class="nav-link text-white fs-6" href="{{ route('user.host_meeting') }}">Live Now</a>
                        </li>
                    @endif --}}

                    <li class="nav-item pe-1">
                        <a class="nav-link text-white fs-6" href="{{ route('smile_tv') }}">Smile TV</a>
                    </li>

                    <li class="nav-item pe-1">
                        <a class="nav-link text-white fs-6" href="{{ route('news') }}">Author Walls</a>
                    </li>
                    <li class="nav-item pe-1">
                        <a class="nav-link text-white fs-6" href="{{ route('faq') }}">FAQ</a>
                    </li>
                    <li class="nav-item ps-2">
                       @yield('search')
                    </li>
                    

                </ul>
                {{-- <select class="my-select selectpicker me-3" data-container="body">
                    <option>Eng</option>
                    <option>Esp</option>
                </select> --}}
                @if (!Auth::guard('general')->user())
                    <a href="{{ url('login') }}">
                        <button class="btn btn-danger" type="submit">Sign In</button>
                    </a>
                @else
                    <a href="{{ route('user.deshboard') }}">
                        <button class="btn btn-danger" type="submit">Dashboard</button>
                    </a>
                @endif

            </div>
        </div>
    </nav>
</header>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Header Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<style>
    form {
	margin: 55px;
}
input {
	outline: none;
}

input[type=search] {
	-webkit-appearance: textfield;
	-webkit-box-sizing: content-box;
	font-family: inherit;
	font-size: 100%;
}
input::-webkit-search-decoration,
input::-webkit-search-cancel-button {
	display: none; 
}
input[type=search] {
	padding: 9px 15px 9px 32px;
	width: 55px;
	background: #ededed url(https://static.tumblr.com/ftv85bp/MIXmud4tx/search-icon.png) no-repeat 9px center;
	border: solid 1px #ccc;
	
	-webkit-border-radius: 10em;
	   -moz-border-radius: 10em;
	        border-radius: 10em;
	
	-webkit-transition: all .5s;
	   -moz-transition: all .5s;
	        transition: all .5s;
}
input[type=search]:focus {
	width: 130px;
	background-color: #fff;
	border-color: #66CC75;
	
	-webkit-box-shadow: 0 0 5px rgba(109,207,246,.5);
	   -moz-box-shadow: 0 0 5px rgba(109,207,246,.5);
	        box-shadow: 0 0 5px rgba(109,207,246,.5);
}

.header-search-input{
    height: 18px;
}
</style>
