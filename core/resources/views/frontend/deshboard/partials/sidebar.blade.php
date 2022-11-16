<div class="sidebar">
    <div class="sidebar__inner">
        <div class="sidebar-top-inner">
            <div class="sidebar__logo">
                <a href="index.html" class="sidebar__main-logo">
                    <img src="{{ asset('assets/frontend/images/logo/logo1.png') }}" alt="logo">
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
                        <a href="{{ route('user.deshboard') }}">
                            <i class="menu-icon las la-home"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="#">
                            <i class="menu-icon las las la-book"></i>
                            <span class="menu-title">@lang('Book')</span>
                        </a>
                        <ul class="sidebar-submenu" style="display:none; list-style-type: none;">
                            <li class="sidebar-menu-item">
                                <a href="{{ route('user.books') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('My Book')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a href="{{ route('user.buying.books.view') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Book Lists')</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="#">
                            <i class="menu-icon las la-calendar-minus"></i>
                            <span class="menu-title">@lang('Events')</span>
                        </a>
                        <ul class="sidebar-submenu" style="display:none; list-style-type: none;">
                            <li class="sidebar-menu-item">
                                <a href="{{ route('user.events') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('My Events')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a href="{{ route('user.buying.plan.ticket.view') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Plan Lists')</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    

                    <li class="sidebar-menu-item">
                        <a href="{{ route('user.news') }}">
                            <i class="menu-icon las fa-solid fa-newspaper"></i>
                            <span class="menu-title">Author wall</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-menu-item">
                        <a href="{{ route('user.buying.event.ticket.view') }}">
                            <i class="menu-icon las la-ticket-alt"></i>
                            <span class="menu-title">Event Ticket</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="#">
                            <i class="menu-icon las la-money-check-alt"></i>
                            <span class="menu-title">@lang('Withdraw')</span>
                        </a>
                        <ul class="sidebar-submenu" style="display:none; list-style-type: none;">
                            <li class="sidebar-menu-item">
                                <a href="{{ route('user.withdraw_history') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Log')</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="sidebar-submenu" style="display:none; list-style-type: none;">
                            <li class="sidebar-menu-item">
                                <a href="{{ route('user.withdraw_history') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('History')</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                   
                    <li class="sidebar-menu-item">
                        <a href="{{ route('user.profile') }}">
                            <i class="menu-icon las fa-solid fa-user-circle"></i>
                            <span class="menu-title">Profile</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('user.password.reset.email.view') }}">
                            <i class="menu-icon las las la-key"></i>
                            <span class="menu-title">Password</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="copyright-wrapper">
            <div class="social-area">
                <ul class="copyright-social p-0">
                    <li><a href="{{ URL($social_link->fb_link) }}"><i class="lab la-facebook-f"></i></a></li>
                    <li class="active"><a href="{{ URL($social_link->twitter_link) }}" class="active"><i
                                class="lab la-twitter"></i></a></li>
                    <li><a href="{{ URL($social_link->instragram_link) }}"><i class="lab la-instagram"></i></a></li>
                    <li><a href="{{ URL($social_link->linkedin_link) }}"><i class="lab la-linkedin-in"></i></a></li>
                </ul>
            </div>
            <div class="copyright-area">
                <p>Copyright © 2022 <a href="#0">Smile Net</a></p>
            </div>
        </div>
    </div>
</div>
