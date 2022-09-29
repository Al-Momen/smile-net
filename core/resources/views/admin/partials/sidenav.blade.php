<div class="sidebar__inner">
    <div class="sidebar__logo">
        <a href="index.html" class="sidebar__main-logo">
            <img src="{{asset('assets/admin/')}}/images/logo/logo.png" white-img="{{ getImage(imagePath()['logoIcon']['path'].'/logo.png', '?'.time()) }}"
            dark-img="{{ getImage(imagePath()['logoIcon']['path'].'/whiteLogo.png', '?'.time()) }}" alt="logo">
        </a>
        <a href="index.html" class="sidebar__logo-shape">
            <img src="{{asset('assets/admin/')}}/images/logo/fav.png" alt="logo">
        </a>
    </div>
    <div class="sidebar__menu-wrapper">
        <ul class="sidebar__menu">
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="menu-icon las la-home"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="sidebar__menu-header">Main</li>
            <li class="sidebar-menu-item">
                <a href="manage-currency.html">
                    <i class="menu-icon las la-coins"></i>
                    <span class="menu-title">Manage Currency</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="fees-&-chargers.html">
                    <i class="menu-icon las la-hand-holding-usd"></i>
                    <span class="menu-title">Fees & Charges</span>
                </a>
            </li>


           
            <li class="sidebar-menu-item sidebar-dropdown

            @if(Route::currentRouteName() == 'admin.users.all') active
            @elseif(Route::currentRouteName() == 'admin.users.active') active
            @elseif(Route::currentRouteName() == 'admin.users.banned') active
            @elseif(Route::currentRouteName() == 'admin.users.email.verified') active
            @elseif(Route::currentRouteName() == 'admin.users.email.unverified') active
            @elseif(Route::currentRouteName() == 'admin.users.sms.verified') active
            @elseif(Route::currentRouteName() == 'admin.users.sms.unverified') active
            @elseif(Route::currentRouteName() == 'admin.users.kyc.verified') active
            @elseif(Route::currentRouteName() == 'admin.users.kyc.unverified') active
            @elseif(Route::currentRouteName() == 'admin.users.email.all') active
            @endif
             ">
                <a href="#0">
                    <i class="menu-icon las la-user-edit"></i>
                    <span class="menu-title">Manage Users</span>
                    <div class="sidebar-item-badge">
                        @if($users_count)
                        <span>{{$users_count}}</span>
                        @else
                        <span>0</span>
                         @endif
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li class="sidebar-menu-item
                    @if(Route::currentRouteName() == 'admin.users.all') active
                    @elseif(Route::currentRouteName() == 'admin.users.active') active
                    @elseif(Route::currentRouteName() == 'admin.users.banned') active
                    @elseif(Route::currentRouteName() == 'admin.users.email.verified') active
                    @elseif(Route::currentRouteName() == 'admin.users.email.unverified') active
                    @elseif(Route::currentRouteName() == 'admin.users.sms.verified') active
                    @elseif(Route::currentRouteName() == 'admin.users.sms.unverified') active
                    @elseif(Route::currentRouteName() == 'admin.users.kyc.verified') active
                    @elseif(Route::currentRouteName() == 'admin.users.kyc.unverified') active
                    @elseif(Route::currentRouteName() == 'admin.users.email.all') active
                    @endif
                    ">
                        <a href="{{ route('admin.users.all') }}" class="nav-link  {{(Route::currentRouteName() == 'admin.users.all')?'active': ''}}">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">All Users</span>
                            <div class="sidebar-item-badge">
                                @if($users_count)
                                <span>{{$users_count}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>
                        <a href="{{route('admin.users.active')}}" class="nav-link  {{(Route::currentRouteName() == 'admin.users.active')?'active': ''}}">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Active Users</span>
                            <div class="sidebar-item-badge style">
                                @if($active_users_count)
                                <span>{{$active_users_count}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>
                        <a href="{{route('admin.users.banned')}}" class="nav-link  {{(Route::currentRouteName() == 'admin.users.banned')?'active': ''}}">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Banned Users</span>
                            <div class="sidebar-item-badge style">
                                @if($banned_users_count)
                                <span>{{$banned_users_count}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>
                        <a href="{{route('admin.users.email.verified')}}" class="nav-link {{(Route::currentRouteName() == 'admin.users.email.verified')?'active': ''}}">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Email Verified </span>
                            <div class="sidebar-item-badge style">
                                @if($email_verified_users_count)
                                <span>{{$email_verified_users_count}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>

                        <a href="{{route('admin.users.email.unverified')}}" class="nav-link {{(Route::currentRouteName() == 'admin.users.email.unverified')?'active': ''}}">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Email Unverified</span>
                            <div class="sidebar-item-badge style">
                                @if($email_unverified_users_count)
                                <span>{{$email_unverified_users_count}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>
                        <a href="{{route('admin.users.sms.verified')}}" class="nav-link {{(Route::currentRouteName() == 'admin.users.sms.verified')?'active': ''}}">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">SMS Verified</span>
                            <div class="sidebar-item-badge style">
                                @if($sms_verified_users_count)
                                <span>{{$sms_verified_users_count}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>
                        <a href="{{route('admin.users.sms.unverified')}}" class="nav-link {{(Route::currentRouteName() == 'admin.users.sms.unverified')?'active': ''}}">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">SMS Unverified</span>
                            <div class="sidebar-item-badge style">
                                @if($sms_unverified_users_count)
                                <span>{{$sms_unverified_users_count}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>
                        <a href="{{route('admin.users.kyc.verified')}}" class="nav-link {{(Route::currentRouteName() == 'admin.users.kyc.verified')?'active': ''}}">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">KYC Verified</span>
                            <div class="sidebar-item-badge style">
                                @if($kyc_verified_users_count)
                                <span>{{$kyc_verified_users_count}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>
                        <a href="{{route('admin.users.kyc.unverified')}}" class="nav-link {{(Route::currentRouteName() == 'admin.users.kyc.unverified')?'active': ''}}">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">KYC Unverified</span>
                            <div class="sidebar-item-badge style">
                                @if($kyc_unverified_users_count)
                                <span>{{$kyc_unverified_users_count}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>
                        <a href="{{ route('admin.users.email.all') }}" class="nav-link {{(Route::currentRouteName() == 'admin.users.email.all')?'active': ''}}">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Email To Users</span>
                        </a>

                    </li>
                </ul>
            </li>
            <li class="sidebar__menu-header">MANAGE KYC</li>
            <li class="sidebar-menu-item  {{menuActive('admin.edit.kyc')}}">
                <a href="{{ route('admin.edit.kyc') }}">
                    <i class="menu-icon lab la-wpforms"></i>
                    <span class="menu-title">KYC Form</span>
                </a>
            </li>
            <li class="sidebar__menu-header">PAYMENT SETTING</li>
            <li class="sidebar-menu-item sidebar-dropdown">
                <a href="#0">
                    <i class="menu-icon las la-wallet"></i>
                    <span class="menu-title">Payment Gateways</span>
                </a>
                <ul class="sidebar-submenu">
                    <li class="sidebar-menu-item">
                        <a href="auto-gateway.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Automatic</span>
                        </a>
                        <a href="manual-gateway.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Manual</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-menu-item sidebar-dropdown">
                <a href="#0">
                    <i class="menu-icon las la-credit-card"></i>
                    <span class="menu-title">Deposits</span>
                </a>
                <ul class="sidebar-submenu">
                    <li class="sidebar-menu-item">
                        <a href="pending-deposit.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Pending</span>
                        </a>
                        <a href="completed-deposit.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Completed</span>
                        </a>
                        <a href="canceled-deposit.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Canceled</span>
                        </a>
                        <a href="all-deposit.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">All</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-menu-item sidebar-dropdown">
                <a href="#0">
                    <i class="menu-icon la la-bank"></i>
                    <span class="menu-title">Withdrawals</span>
                </a>
                <ul class="sidebar-submenu">
                    <li class="sidebar-menu-item">
                        <a href="withdraw-method.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Methods</span>
                        </a>
                        <a href="pending-withdraw.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Pending</span>
                        </a>
                        <a href="completed-withdraw.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Completed</span>
                        </a>
                        <a href="canceled-withdraw.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Canceled</span>
                        </a>
                        <a href="all-withdraw.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">All</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar__menu-header">FRONTEND MANAGER</li>
            <li class="sidebar-menu-item sidebar-dropdown">
                <a href="#0" class="">
                    <i class="menu-icon las la-terminal"></i>
                    <span class="menu-title">Manage Section</span>
                </a>

                    <ul class="sidebar-submenu">
                        @php
                           $lastSegment =  collect(request()->segments())->last();
                        @endphp

                                <li class="sidebar-menu-item ">
                                    @foreach(getPageSections(true) as $k => $secs)
                                    @if($secs['builder'])

                                    <a href="{{ route('admin.frontend.sections',$k) }}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">{{__($secs['name'])}}</span>
                                    </a>
                                    @endif
                                    @endforeach
                                </li>



                    </ul>

            </li>
            <li class="sidebar-menu-item {{menuActive('admin.seo')}}">
                <a href="{{ route('admin.seo') }}">
                    <i class="menu-icon las la-globe"></i>
                    <span class="menu-title">SEO Manager</span>
                </a>
            </li>
            <li class="sidebar__menu-header">SUPPORTS</li>
            <li class="sidebar-menu-item sidebar-dropdown
                @if(Route::currentRouteName() == 'admin.ticket') active
                @elseif(Route::currentRouteName() == 'admin.ticket.pending') active
                @elseif(Route::currentRouteName() == 'admin.ticket.answered') active
                @elseif(Route::currentRouteName() == 'admin.ticket.closed') active

                @endif
             ">
                <a href="#0">
                    <i class="menu-icon las la-ticket-alt"></i>
                    <span class="menu-title">Support</span>
                    <div class="sidebar-item-badge">
                        @if($support_tickets)
                        <span>{{$support_tickets}}</span>
                        @else
                        <span>0</span>
                         @endif
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li class="sidebar-menu-item  {{(Route::currentRouteName() == 'admin.ticket')?'active': ''}}">
                        <a href="{{ route('admin.ticket') }}" class="nav-link ">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">All</span>
                            <div class="sidebar-item-badge">
                                @if($support_tickets)
                                <span>{{$support_tickets}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>
                    </li>
                    <li class="sidebar-menu-item  {{(Route::currentRouteName() == 'admin.ticket.pending')?'active': ''}}">
                        <a href="{{ route('admin.ticket.pending') }}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Pending</span>
                            <div class="sidebar-item-badge">
                                @if($pending_ticket_count)
                                <span>{{$pending_ticket_count}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>
                    </li>
                    <li class="sidebar-menu-item  {{(Route::currentRouteName() == 'admin.ticket.answered')?'active': ''}}">
                        <a href="{{ route('admin.ticket.answered') }}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Answered</span>
                            <div class="sidebar-item-badge">
                                @if($support_ticket_answerd_count)
                                <span>{{$support_ticket_answerd_count}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>
                    </li>
                    <li class="sidebar-menu-item  {{(Route::currentRouteName() == 'admin.ticket.closed')?'active': ''}}">
                        <a href="{{ route('admin.ticket.closed') }}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Closed</span>
                            <div class="sidebar-item-badge">
                                @if($support_ticket_closed_count)
                                <span>{{$support_ticket_closed_count}}</span>
                                @else
                                <span>0</span>
                                 @endif
                            </div>
                        </a>
                    </li>


                </ul>
            </li>
            <li class="sidebar__menu-header">Settings</li>
            <li class="sidebar-menu-item sidebar-dropdown {{menuActive('admin.setting*')}}">
                <a href="#0">
                    <i class="menu-icon las la-cog"></i>
                    <span class="menu-title">General Settings</span>
                </a>
                <ul class="sidebar-submenu {{menuActive('admin.setting*')}} ">
                    <li class="sidebar-menu-item {{menuActive('admin.setting*')}}">
                        <a href="{{ route('admin.setting.index') }}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Site Settings</span>
                        </a>
                        <a href="{{ route('admin.setting.logo.icon') }}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Logo & favicon</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-menu-item sidebar-dropdown">
                <a href="#0">
                    <i class="menu-icon las la-mobile"></i>
                    <span class="menu-title">App Settings</span>
                </a>
                <ul class="sidebar-submenu">
                    <li class="sidebar-menu-item">
                        <a href="splash-screen.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Splash Screen</span>
                        </a>
                        <a href="on-bords.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Onbords</span>
                        </a>
                        <a href="app-link.html" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Apps Link</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-menu-item  {{menuActive('admin.extensions.index')}}">
                <a href="{{ route('admin.extensions.index') }}">
                    <i class="menu-icon las la-puzzle-piece"></i>
                    <span class="menu-title">Extensions</span>
                </a>
            </li>
            <li class="sidebar-menu-item {{menuActive('admin.language.manage')}}">
                <a href="{{ route('admin.language.manage') }}">
                    <i class="menu-icon las la-language"></i>
                    <span class="menu-title">Languages</span>
                </a>
            </li>
            <li class="sidebar__menu-header">NOTIFY SETTINGS</li>
            <li class="sidebar-menu-item sidebar-dropdown {{menuActive('admin.email-template*')}}">
                <a href="#0" class="">
                    <i class="menu-icon las la-envelope-open-text"></i>
                    <span class="menu-title">Email Manager</span>
                </a>
                <ul class="sidebar-submenu {{menuActive('admin.email-template*')}} ">
                    <li class="sidebar-menu-item {{menuActive('admin.email-template*')}}">
                        <a href="{{ route('admin.email.template.global') }}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Global Template</span>
                        </a>
                        <a href="{{ route('admin.email.template.index') }}" class="nav-link active">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Default Template</span>
                        </a>
                        <a href="{{ route('admin.email.template.setting') }}" class="nav-link ">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Email Configuration</span>
                        </a>


                    </li>
                </ul>
            </li>
            <li class="sidebar-menu-item sidebar-dropdown {{menuActive('admin.sms.template*',3)}} ">
                <a  href="javascript:void(0)"  class="{{menuActive('admin.sms.template*',3)}}">
                    <i class="menu-icon las la-sms"></i>
                    <span class="menu-title">SMS Manager</span>
                </a>
                <ul class="sidebar-submenu">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.sms.templates.setting') }}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">SMS Gateways</span>
                        </a>
                        <a href="{{ route('admin.sms.template.global') }}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">Global Settings</span>
                        </a>
                        <a href="{{ route('admin.sms.templates.index') }}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">SMS Template</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-menu-item">
                <a href="push-notification.html">
                    <i class="menu-icon las la-bell"></i>
                    <span class="menu-title">Push Notification</span>
                </a>
            </li>
            <li class="sidebar__menu-header">Ads Settings</li>
            <li class="sidebar-menu-item">
                <a href="google-admob.html">
                    <i class="menu-icon lab la-google"></i>
                    <span class="menu-title">Google Admob</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="facebook-ad.html">
                    <i class="menu-icon lab la-facebook"></i>
                    <span class="menu-title">Facebook Ad</span>
                </a>
            </li>
            <li class="sidebar__menu-header">Extra</li>
            <li class="sidebar-menu-item {{menuActive('admin.setting.cookie')}}">
                <a href="{{ route('admin.setting.cookie') }}">
                    <i class="menu-icon las la-cookie-bite"></i>
                    <span class="menu-title">GDPR Cookie</span>
                </a>
            </li>
            <li class="sidebar-menu-item {{menuActive('admin.system.info')}}">
                <a href="{{ route('admin.system.info') }}">
                    <i class="menu-icon las la-sitemap"></i>
                    <span class="menu-title">System Info</span>
                </a>
            </li>
            <li class="sidebar-menu-item {{menuActive('admin.setting.optimize')}}">
                <a href="{{ route('admin.setting.optimize') }}">
                    <i class="menu-icon las la-broom"></i>
                    <span class="menu-title">Clear Cache</span>
                </a>
            </li>
        </ul>
    </div>
</div>
