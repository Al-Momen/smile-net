<div class="sidebar__menu-wrapper">
    <ul class="sidebar__menu">
        <li class="sidebar-menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="menu-icon las la-home"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        {{-- <li class="sidebar-menu-item {{ Request::is('currency/list') ? 'active' : '' }}">
            <a href="{{ route('admin.currency.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Currency</span>
            </a>
        </li> --}}

        <li class="sidebar-menu-item  @if (Request::is('admin/category')) active @endif">
            <a href="{{ route('admin.category.index') }}" class="nav-link">
                <i class="menu-icon las la-list-alt"></i>
                <span class="menu-title">Category</span>
            </a>
        </li>

        <li class="sidebar-menu-item @if (Request::is('admin/ticket-type')) active @endif ">
            <a href="{{ route('admin.ticket.type.index') }}" class="nav-link">
                <i class="menu-icon las la-ticket-alt"></i>
                <span class="menu-title">Subscription Plan</span>
            </a>
        </li>
        {{-- 
        <li class="sidebar-menu-item ">
            <a href="{{ route('admin.event.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Events</span>
            </a>
        </li> --}}
        <li class="sidebar-menu-item @if (Request::is('admin/price')) active @endif">
            <a href="{{ route('admin.price.index') }}" class="nav-link">
                <i class="menu-icon las la-dollar-sign"></i>
                <span class="menu-title">Currency</span>
            </a>
        </li>

        <li class="sidebar-menu-item sidebar-dropdown
        
        @if (Request::is('admin/manage/site') ||
                Request::is('admin/seo*') ||
                Request::is('smile-net/admin/social') ||
                Request::is('admin/manage/site')) active @endif">
            <a href="#0" class="">
                <i class="menu-icon las la-terminal"></i>
                <span class="menu-title">Manage Section</span>
            </a>
            <ul class="sidebar-submenu"
                @if (Request::is('admin/manage/site') ||
                        Request::is('admin/seo*') ||
                        Request::is('smile-net/admin/social') ||
                        Request::is('admin/footer')||
                        Request::is('admin/faq')) style="display:block"
            @else
                style="display:none" @endif>
                @php
                    $lastSegment = collect(request()->segments())->last();
                @endphp

                <li class="sidebar-menu-item">

                <li class="sidebar-menu-item @if (Request::is('admin/manage/site')) active @endif">
                    <a href="{{ route('admin.manage.site') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">Site Banner</span>
                    </a>
                </li>
                <li class="sidebar-menu-item sidebar-dropdown {{ Request::is('admin/seo*') ? 'active' : '' }} ">
                <li class="sidebar-menu-item {{ Request::is('admin/seo*') ? 'active' : '' }}">
                    <a href="{{ route('admin.seo.page') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title"{{ Request::is('admin/seo/manage') ? 'text--base' : ' ' }}>SEO Manager</span>
                    </a>
                </li>
        </li>
        <li class="sidebar-menu-item @if (Request::is('smile-net/admin/social')) active @endif">
            <a href="{{ route('admin.social.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Social Link</span>
            </a>
        </li>
        <li class="sidebar-menu-item @if (Request::is('admin/footer')) active @endif">
            <a href="{{ route('admin.footer.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Footer section</span>
            </a>
        </li>
        <li class="sidebar-menu-item @if (Request::is('admin/faq')) active @endif">
            <a href="{{ route('admin.faq.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">FAQ section</span>
            </a>
        </li>
        {{-- @foreach (getPageSections(true) as $k => $secs)
                        @if ($secs['builder'])
                            <a href="{{ route('admin.frontend.sections', $k) }}" class="nav-link">
                                <i class="menu-icon las la-dot-circle"></i>
                                <span class="menu-title">{{ __($secs['name']) }}</span>
                            </a>
                        @endif
                    @endforeach --}}
        </li>

    </ul>
    </li>


    <li class="sidebar-menu-item sidebar-dropdown 
        @if (Request::is('admin/vote') || Request::is('admin/all/votes')) active @endif">
        <a href="#">
            <i class="menu-icon las la-vote-yea"></i>
            <span class="menu-title">@lang('Manage Vote')</span>
        </a>
        <ul class="sidebar-submenu"
            @if (Request::is('admin/vote') || Request::is('admin/all/votes')) style="display:block"
            @else
                style="display:none" @endif>
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.vote.index') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Vote')</span>
                </a>
                <a href="{{ route('admin.all.vote') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('All Logs')</span>
                </a>
            </li>
        </ul>
    </li>



    <li class="sidebar-menu-item sidebar-dropdown 
        @if (Request::is('admin/all-users') ||
                Request::is('admin/active-users') ||
                Request::is('admin/banned-users') ||
                Request::is('admin/plan')) active @endif">
        <a href="#">
            <i class="menu-icon las la-user-edit"></i>
            <span class="menu-title">@lang('Manage Users')</span>
        </a>
        <ul class="sidebar-submenu"
            @if (Request::is('admin/all-users') ||
                    Request::is('admin/active-users') ||
                    Request::is('admin/banned-users') ||
                    Request::is('admin/plan')) style="display:block"
            @else
                style="display:none" @endif>
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.all.users') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('All Users')</span>
                </a>
                <a href="{{ route('admin.active.users') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Active Users')</span>
                </a>
                <a href="{{ route('admin.banned.users') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Banned Users')</span>
                </a>
                <a href="{{ route('admin.plan.users') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Plan Users')</span>
                </a>
            </li>
        </ul>
    </li>


    <li class="sidebar-menu-item sidebar-dropdown @if (Request::is('admin/book') ||
            Request::is('admin/all/books') ||
            Request::is('admin/book/manual/index') ||
            Request::is('admin/user/book/approved') ||
            Request::is('admin/user/book/pending') ||
            Request::is('admin/user/book/reject')) active @endif">
        <a href="#">
            <i class="menu-icon las la-book-open"></i>
            <span class="menu-title">@lang('Manage Books')</span>
        </a>
        <ul class="sidebar-submenu"
            @if (Request::is('admin/book') ||
                    Request::is('admin/all/books') ||
                    Request::is('admin/book/manual/index') ||
                    Request::is('admin/user/book/approved') ||
                    Request::is('admin/user/book/pending') ||
                    Request::is('admin/user/book/reject')) style="display:block"
            @else
                style="display:none" @endif>
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.book.index') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('My Books')</span>
                </a>
                <a href="{{ route('admin.book.all.books') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('All Books')</span>
                </a>
                <a href="{{ route('admin.book.manual.index') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('All Logs')</span>
                </a>
                <a href="{{ route('admin.book.approved') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Approved logs')</span>
                </a>
                <a href="{{ route('admin.book.pending') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Pending logs')</span>
                </a>

                <a href="{{ route('admin.book.reject') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Rejected logs')</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="sidebar-menu-item sidebar-dropdown @if (Request::is('admin/events') ||
            Request::is('admin/all/events') ||
            Request::is('admin/event-plan/manual/index') ||
            Request::is('admin/user/event-plan/approved') ||
            Request::is('admin/user/event-plan/pending') ||
            Request::is('admin/user/event-plan/reject')) active @endif">
        <a href="#">
            <i class="menu-icon las la-bullhorn"></i>
            <span class="menu-title">@lang('Manage Events')</span>
        </a>
        <ul class="sidebar-submenu"
            @if (Request::is('admin/events') ||
                    Request::is('admin/all/events') ||
                    Request::is('admin/event-plan/manual/index') ||
                    Request::is('admin/user/event-plan/approved') ||
                    Request::is('admin/user/event-plan/pending') ||
                    Request::is('admin/user/event-plan/reject')) style="display:block"
            @else
                style="display:none" @endif>
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.index.events') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('My Events')</span>
                </a>
                <a href="{{ route('admin.event.all.events') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('All Events')</span>
                </a>
                <a href="{{ route('admin.event.manual.index') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('All Logs')</span>
                </a>
                <a href="{{ route('admin.event.approved') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Approved logs')</span>
                </a>
                <a href="{{ route('admin.event.pending') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Pending logs')</span>
                </a>

                <a href="{{ route('admin.event.reject') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Rejected logs')</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="sidebar-menu-item sidebar-dropdown @if (Request::is('admin/ticket/index') ||
            Request::is('admin/user/ticket/approved') ||
            Request::is('admin/user/ticket/pending') ||
            Request::is('admin/user/ticket/reject')) active @endif">
        <a href="#">
            <i class="menu-icon las la-ticket-alt"></i>
            <span class="menu-title">@lang('Manage Plan')</span>
        </a>
        <ul class="sidebar-submenu"
            @if (Request::is('admin/ticket/index') ||
                    Request::is('admin/user/ticket/approved') ||
                    Request::is('admin/user/ticket/pending') ||
                    Request::is('admin/user/ticket/reject')) style="display:block"
            @else
                style="display:none" @endif>
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.ticket.index') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('All Logs')</span>
                </a>
                <a href="{{ route('admin.ticket.approved') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Approved logs')</span>
                </a>
                <a href="{{ route('admin.ticket.pending') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Pending logs')</span>
                </a>

                <a href="{{ route('admin.ticket.reject') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Rejected logs')</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="sidebar-menu-item sidebar-dropdown @if (Request::is('admin/news') || Request::is('admin/all/news')) active @endif">
        <a href="#">
            <i class="menu-icon las la-newspaper"></i>
            <span class="menu-title">@lang('Author walls')</span>
        </a>
        <ul class="sidebar-submenu"
            @if (Request::is('admin/news') || Request::is('admin/all/news')) style="display:block"
            @else
                style="display:none" @endif>
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.news.index') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('My walls')</span>
                </a>
                <a href="{{ route('admin.all.news') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('All walls')</span>
                </a>
            </li>
        </ul>
    </li>


    <li class="sidebar-menu-item sidebar-dropdown @if (Request::is('admin/home/new-item-season/manage') ||
            Request::is('admin/home/top/manage') ||
            Request::is('admin/home/comming-soon/manage')) active @endif">
        <a href="#">
            <i class="menu-icon las la-video"></i>
            <span class="menu-title">@lang('Movies')</span>
        </a>
        <ul class="sidebar-submenu"
            @if (Request::is('admin/home/new-item-season/manage') ||
                    Request::is('admin/home/top/manage') ||
                    Request::is('admin/home/comming-soon/manage')) style="display:block"
            @else
                style="display:none" @endif>
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.home.newItemSeason') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('New Item of Season')</span>
                </a>
                <a href="{{ route('admin.home.top.movies') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Top Movies')</span>
                </a>
                <a href="{{ route('admin.home.comming.soon.movies') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Coming Soon Movies')</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="sidebar-menu-item sidebar-dropdown @if (Request::is('admin/music') || Request::is('admin/video/music')) active @endif">
        <a href="#">
            {{-- <i class="menu-icon las la-wallet"></i> --}}
            <i class="menu-icon las la-music"></i>
            <span class="menu-title">@lang('Music')</span>
        </a>
        <ul class="sidebar-submenu"
            @if (Request::is('admin/music') || Request::is('admin/video/music')) style="display:block"
            @else
                style="display:none" @endif>
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.music.index') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Audio Music')</span>
                </a>
                <a href="{{ route('admin.video.music.index') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Video Music')</span>
                </a>

            </li>
        </ul>
    </li>


    <li class="sidebar-menu-item @if (Request::is('admin/coupon')) active @endif">
        <a href="{{ route('admin.coupon.index') }}" class="nav-link">
            <i class="menu-icon las la-barcode"></i>
            <span class="menu-title">Coupons</span>
        </a>
    </li>


    <li class="sidebar-menu-item @if (Request::is('admin/smile-tv')) active @endif">
        <a href="{{ route('admin.smile.tv.index') }}" class="nav-link">
            <i class="menu-icon las la-desktop"></i>
            <span class="menu-title">Smile Tv</span>
        </a>
    </li>
    {{-- <li class="sidebar-menu-item ">
            <a href="{{ route('admin.live.tv.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Live Now</span>
            </a>
        </li> --}}
    {{-- <li class="sidebar-menu-item ">
            <a href="{{ route('admin.news.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">News</span>
            </a>
        </li> --}}

    {{-- <li class="sidebar-menu-item ">
            <a href="{{ route('admin.social.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Movies Category</span>
            </a>
        </li> --}}


    <li class="sidebar-menu-item sidebar-dropdown 
        @if (Request::is('admin/gateway/automatic') || 
        Request::is('admin/gateway/manual')) active 
        @endif">
        <a href="#">
            <i class="menu-icon las la-wallet"></i>
            <span class="menu-title">@lang('Payments Getway')</span>
        </a>
        <ul class="sidebar-submenu"
            @if (Request::is('admin/gateway/automatic') || Request::is('admin/gateway/manual')) style="display:block"
            @else
                style="display:none" @endif>
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.gateway.automatic.index') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Automatic Getways')</span>
                </a>
                <a href="{{ route('admin.gateway.manual.index') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Manual Getways')</span>
                </a>

            </li>
        </ul>
    </li>

    {{-- <li class="sidebar-menu-item sidebar-dropdown @if (Request::is('admin/host_meeting') || Request::is('admin/join_meeting') || Request::is('admin/meeting_history')) active @endif">
            <a href="#">
                <i class="menu-icon las fa-solid fa-tv"></i>
                <span class="menu-title">@lang('Live Now')</span>
            </a>
            <ul class="sidebar-submenu"
                @if (Request::is('admin/host_meeting') || Request::is('admin/join_meeting') || Request::is('admin/meeting_history')) style="display:block"
            @else
                style="display:none" @endif>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.host_meeting') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Host Meeting')</span>
                    </a>
                    <a href="{{ route('admin.join_meeting') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Join Meeting')</span>
                    </a>
                    <a href="{{ route('admin.meeting_history') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('History')</span>
                    </a>
                </li>
            </ul>
        </li> --}}


    <li class="sidebar-menu-item sidebar-dropdown @if (Request::is('admin/manual-payment') ||
            Request::is('admin/user/withdraw/approved') ||
            Request::is('admin/user/withdraw/pending') ||
            Request::is('admin/user/withdraw/reject') ||
            Request::is('admin/user/manual-getway/request')) active @endif">
        <a href="#">
            <i class="menu-icon las la-receipt"></i>
            <span class="menu-title">@lang('Withdraws')</span>
        </a>
        <ul class="sidebar-submenu"
            @if (Request::is('admin/manual-payment') ||
                    Request::is('admin/user/withdraw/approved') ||
                    Request::is('admin/user/withdraw/pending') ||
                    Request::is('admin/user/withdraw/reject') ||
                    Request::is('admin/user/manual-getway/request')) style="display:block"
            @else
                 @endif>
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.manual.paymentgetway.view') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Withdraw Method')</span>
                </a>
                <a href="{{ route('admin.withdraw.approved') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Approved logs')</span>
                </a>
                <a href="{{ route('admin.withdraw.pending') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Pending logs')</span>
                </a>

                <a href="{{ route('admin.withdraw.reject') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Rejected logs')</span>
                </a>
                <a href="{{ route('admin.withdraw.request') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Withdraw logs')</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="sidebar__menu-header">NOTIFY SETTINGS</li>


    <li class="sidebar-menu-item sidebar-dropdown {{ Request::is('admin/email-template*') ? 'active' : '' }}">
        <a href="#" class="">
            <i class="menu-icon las la-envelope-open-text"></i>
            <span class="menu-title">Email Manager</span>
        </a>
        <ul class="sidebar-submenu" @if (Request::is('admin/email-template*')) style="display:block" @endif>

            <li class="sidebar-menu-item">
                <a href="{{ route('admin.email.template.global') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span
                        class="menu-title {{ Request::is('admin/email-template/global') ? 'text--base' : '' }}">Global Template</span>
                </a>
                <a href="{{ route('admin.email.template.setting') }}" class="nav-link ">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span
                        class="menu-title {{ Request::is('admin/email-template/setting') ? 'text--base' : '' }}">Email Configuration</span>
                    <a href="{{ route('admin.email.template.index') }}" class="nav-link active">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span
                            class="menu-title {{ Request::is('admin/email-template/index') ? 'text--base' : '' }}">Email notification</span>
                    </a>
                </a>
            </li>
        </ul>
    </li>

    <li class="sidebar__menu-header">Settings</li>
    <li class="sidebar-menu-item sidebar-dropdown {{ Request::is('admin/setting*') ? 'active' : ' ' }}">
        <a href="#">
            <i class="menu-icon las la-cog"></i>
            <span class="menu-title">General Settings</span>
        </a>

        <ul class="sidebar-submenu {{ Request::is('admin/setting*') ? 'd-block' : ' ' }}">
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.setting.index') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title {{ Request::is('admin/setting/index') ? 'text--base' : ' ' }}">Site Settings</span>
                </a>
                <a href="{{ route('admin.setting.logo.icon') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title {{ Request::is('admin/setting/logo-icon') ? 'text--base' : ' ' }}">Logo & favicon</span>
                </a>

                <a href="{{ route('admin.setting.extensions.index') }}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span
                        class="menu-title {{ Request::is('admin/setting/extensions/list') ? 'text-white' : ' ' }}">Extensions</span>
                </a>
                

            </li>
        </ul>
    </li>
</div>
