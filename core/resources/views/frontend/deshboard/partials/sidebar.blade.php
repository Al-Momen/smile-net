<div class="sidebar">
    <div class="sidebar__inner">
        <div class="sidebar-top-inner">
            <div class="sidebar__logo">
                <a href="index.html" class="sidebar__main-logo">
                    <img src="{{asset('assets/frontend/images/logo/logo1.png')}}" alt="logo">
                </a>
                <div class="navbar__left">
                    <button class="navbar__expand">
                        <i class="las la-bars"></i>
                    </button>
                    <button class="sidebar-mobile-menu">
                        <i class="las la-bars"></i>
                    </button>
                </div>
            </div>
            <div class="sidebar__menu-wrapper">
                <ul class="sidebar__menu p-0">
                    <li class="sidebar-menu-item active">
                        <a href="dashboard.html">
                            <i class="menu-icon las la-home"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{route('user.events')}}">
                            <i class="menu-icon las la-credit-card"></i>
                            <span class="menu-title">Events</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{route('user.book')}}">
                            <i class="menu-icon las fa-solid fa-book"></i>
                            <span class="menu-title">Book</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{route('user.news')}}">
                            <i class="menu-icon las fa-solid fa-newspaper"></i>
                            <span class="menu-title">News</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="copyright-wrapper">
            <div class="social-area">
                <ul class="copyright-social p-0">
                    <li><a href="#0"><i class="lab la-facebook-f"></i></a></li>
                    <li class="active"><a href="#0" class="active"><i class="lab la-twitter"></i></a></li>
                    <li><a href="#0"><i class="lab la-instagram"></i></a></li>
                    <li><a href="#0"><i class="lab la-linkedin-in"></i></a></li>
                </ul>
            </div>
            <div class="copyright-area">
                <p>Copyright © 2022 <a href="#0">Smile Net</a></p>
            </div>
        </div>
    </div>
</div>