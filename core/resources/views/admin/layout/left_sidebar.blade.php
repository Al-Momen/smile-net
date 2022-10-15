<div class="sidebar__menu-wrapper">
    <ul class="sidebar__menu">
        <li class="sidebar-menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="menu-icon las la-home"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="sidebar-menu-item {{ Request::is('currency/list') ? 'active' : '' }}">
            <a href="{{ route('admin.currency.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Currency</span>
            </a>
        </li>

        <li class="sidebar-menu-item ">
            <a href="{{ route('admin.category.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Category</span>
            </a>
        </li>

        <li class="sidebar-menu-item ">
            <a href="{{ route('admin.ticket.type.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title"> Ticket Types</span>
            </a>
        </li>

        <li class="sidebar-menu-item ">
            <a href="{{ route('admin.event.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Events</span>
            </a>
        </li>
        <li class="sidebar-menu-item ">
            <a href="{{ route('admin.price.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Price</span>
            </a>
        </li>
        <li class="sidebar-menu-item ">
            <a href="{{ route('admin.vote.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Vote</span>
            </a>
        </li>
        <li class="sidebar-menu-item ">
            <a href="{{ route('admin.book.index') }}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Magazine</span>
            </a>
        </li>
        <li class="sidebar-menu-item ">
            <a href="" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Live Now</span>
            </a>
        </li>
        <li class="sidebar-menu-item ">
            <a href="" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Music</span>
            </a>
        </li>
        <li class="sidebar-menu-item ">
            <a href="" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">Smile Tv</span>
            </a>
        </li>
        <li class="sidebar-menu-item ">
            <a href="" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">News</span>
            </a>
        </li>

        <li class="sidebar-menu-item sidebar-dropdown @if (Request::is('admin-users') || Request::is('user-group') || Request::is('admin-user/new')) active @endif">
            <a href="#">
                <i class="menu-icon las la-user-edit"></i>
                <span class="menu-title">@lang('left_menu.admin_management')</span>
            </a>
            <ul class="sidebar-submenu"
                @if (Request::is('admin-users') || Request::is('user-group') || Request::is('admin-user/new')) style="display:block"
            @else
                style="display:none" @endif>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.admin-user') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('left_menu.admin_user')</span>
                    </a>
                    <a href="{{ route('admin.user-group') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">User group</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="sidebar-menu-item sidebar-dropdown @if (Request::is('role')) active @endif">
            <a href="#">
                <i class="menu-icon las la-user-edit"></i>
                <span class="menu-title">Manage Roles</span>
            </a>
            <ul class="sidebar-submenu" @if (Request::is('role') || Request::is('permission-group') || Request::is('permission')) style="display:block"
            @else
                style="display:none" @endif>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.role') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title @if(Request::is('role')) text-white @endif">@lang('left_menu.role')</span>
                    </a>
                    <a href="{{ route('admin.permission-group') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title @if(Request::is('permission-group')) text-white @endif">@lang('left_menu.menus')</span>
                    </a>
                    <a href="{{ route('admin.permission.index') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title @if(Request::is('permission')) text-white @endif">@lang('left_menu.actions')</span>

                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-menu-item sidebar-dropdown {{ Request::is('users*') ? 'active' : '' }}">
            <a href="#">
                <i class="menu-icon las la-user-edit"></i>
                <span class="menu-title">Manage Users</span>
                <div class="sidebar-item-badge">
                    @if ($users_count)
                        <span>{{ $users_count }}</span>
                    @else
                        <span>0</span>
                    @endif
                </div>
            </a>
            <ul class="sidebar-submenu" @if (Request::is('users*')) style="display:block"
            @else
                style="display:none" @endif>
                <li
                    class="sidebar-menu-item">
                    <a href="{{ route('admin.users.all') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title @if(Request::is('users/list')) text-white @endif">All Users</span>
                        <div class="sidebar-item-badge">
                            @if ($users_count)
                                <span>{{ $users_count }}</span>
                            @else
                                <span>0</span>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('admin.users.active') }}"
                        class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('users/active') ? 'text-white' : '' }}">Active Users</span>
                        <div class="sidebar-item-badge style">
                            @if ($active_users_count)
                                <span>{{ $active_users_count }}</span>
                            @else
                                <span>0</span>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('admin.users.banned') }}"
                        class="nav-link  {{ Route::currentRouteName() == 'admin.users.banned' ? 'active' : '' }}">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('users/banned') ? 'text-white' : '' }}">Banned Users</span>
                        <div class="sidebar-item-badge style">
                            @if ($banned_users_count)
                                <span>{{ $banned_users_count }}</span>
                            @else
                                <span>0</span>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('admin.users.email.verified') }}"
                        class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('users/email-verified') ? 'text-white' : '' }}">Email Verified </span>
                        <div class="sidebar-item-badge style">
                            @if ($email_verified_users_count)
                                <span>{{ $email_verified_users_count }}</span>
                            @else
                                <span>0</span>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('admin.users.email.unverified') }}"
                        class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('users/email-unverified') ? 'text-white' : '' }}">Email Unverified</span>
                        <div class="sidebar-item-badge style">
                            @if ($email_unverified_users_count)
                                <span>{{ $email_unverified_users_count }}</span>
                            @else
                                <span>0</span>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('admin.users.sms.verified') }}"
                        class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('users/sms-verified') ? 'text-white' : '' }}">SMS Verified</span>
                        <div class="sidebar-item-badge style">
                            @if ($sms_verified_users_count)
                                <span>{{ $sms_verified_users_count }}</span>
                            @else
                                <span>0</span>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('admin.users.sms.unverified') }}"
                        class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('users/sms-unverified') ? 'text-white' : '' }}">SMS Unverified</span>
                        <div class="sidebar-item-badge style">
                            @if ($sms_unverified_users_count)
                                <span>{{ $sms_unverified_users_count }}</span>
                            @else
                                <span>0</span>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('admin.users.kyc.verified') }}"
                        class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('users/kyc-verified') ? 'text-white' : '' }}">KYC Verified</span>
                        <div class="sidebar-item-badge style">
                            @if ($kyc_verified_users_count)
                                <span>{{ $kyc_verified_users_count }}</span>
                            @else
                                <span>0</span>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('admin.users.kyc.unverified') }}"
                        class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('users/kyc-unverified') ? 'text-white' : '' }}">KYC Unverified</span>
                        <div class="sidebar-item-badge style">
                            @if ($kyc_unverified_users_count)
                                <span>{{ $kyc_unverified_users_count }}</span>
                            @else
                                <span>0</span>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('admin.users.email.all') }}"
                        class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('users/send-email') ? 'text-white' : '' }}">Email To Users</span>
                    </a>

                </li>

            </ul>
        </li>
        <li class="sidebar__menu-header">MANAGE KYC</li>
        <li class="sidebar-menu-item @if (Request::is('kyc/edit')) active @endif">
            <a href="{{ route('admin.kyc.edit') }}">
                <i class="menu-icon lab la-wpforms"></i>
                <span class="menu-title">KYC Form</span>
            </a>
        </li>
        <li class="sidebar__menu-header">NOTIFY SETTINGS</li>
        <li class="sidebar-menu-item sidebar-dropdown {{ Request::is('email-template*') ? 'active' : ''}}">
            <a href="#" class="">
                <i class="menu-icon las la-envelope-open-text"></i>
                <span class="menu-title">Email Manager</span>
            </a>
            <ul class="sidebar-submenu" @if (Request::is('email-template*'))
            style="display:block"
            @endif>

                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.email.template.global') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('email-template/global') ? 'text-white' : '' }}">Global Template</span>
                    </a>
                    <a href="{{ route('admin.email.template.index') }}" class="nav-link active">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('email-template/index') ? 'text-white' : '' }}">Default Template</span>
                    </a>
                    <a href="{{ route('admin.email.template.setting') }}" class="nav-link ">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('email-template/setting') ? 'text-white' : '' }}">Email Configuration</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-menu-item sidebar-dropdown {{ Request::is('sms-template*') ? 'active' : '' }}">
            <a href="javascript:void(0)">
                <i class="menu-icon las la-sms"></i>
                <span class="menu-title">SMS Manager</span>
            </a>
            <ul class="sidebar-submenu {{ Request::is('sms-template*') ? 'd-block' : '' }}">
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.sms.templates.setting') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('sms-template/setting') ? 'text-white' : ' ' }}">SMS Gateways</span>                    </a>
                    <a href="{{ route('admin.sms.templates.home') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('sms-template/global') ? 'text-white' : ' ' }}">Global Settings</span>
                    </a>
                    <a href="{{ route('admin.sms.templates.index') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('sms-template/index') ? 'text-white' : ' ' }}">SMS Template</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="sidebar__menu-header">Settings</li>
        <li class="sidebar-menu-item sidebar-dropdown {{ Request::is('setting*') ? 'active' : ' ' }}">
            <a href="#">
                <i class="menu-icon las la-cog"></i>
                <span class="menu-title">General Settings</span>
            </a>

            <ul class="sidebar-submenu {{ Request::is('setting*') ? 'd-block' : ' ' }}">
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.setting.index') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('setting/index') ? 'text-white' : ' ' }}">Site Settings</span>
                    </a>
                    <a href="{{ route('admin.setting.logo.icon') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('setting/logo-icon') ? 'text-white' : ' ' }}">Logo & favicon</span>
                    </a>

                    <a href="{{ route('admin.setting.extensions.index') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{ Request::is('setting/logo-icon') ? 'text-white' : ' ' }}">Extensions</span>
                    </a>

                </li>
            </ul>
        </li>
        <li class="sidebar-menu-item sidebar-dropdown {{  Request::is('payment/gateway*') ? 'active' : ' '}}">
            <a href="#">
                <i class="menu-icon las la-cog"></i>
                <span class="menu-title">Payment Gateways</span>
            </a>
            <ul class="sidebar-submenu {{ Request::is('payment/gateway*') ? 'd-block' : ' '}}">
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.gateway.automatic.index') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{  Request::is('payment/gateway/automatic/index') ? 'text-white' : ' '}}">Automatic</span>
                    </a>
                    <a href="{{ route('admin.gateway.manual.index') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{  Request::is('payment/gateway/manual/index') ? 'text-white' : ' '}}">Manual</span>
                    </a>
                </li>
            </ul>

        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('admin.setting.seo.page') }}">
                <i class="menu-icon las la-globe"></i>
                <span class="menu-title">SEO Manager</span>
            </a>
        </li>
        <li class="sidebar-menu-item sidebar-dropdown {{  Request::is('extra*') ? 'active' : ' '}}">
            <a href="#">
                <i class="menu-icon las la-cog"></i>
                <span class="menu-title">Extra</span>
            </a>
            <ul class="sidebar-submenu {{  Request::is('extra*') ? 'd-block' : ' '}}">
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.extra.clear.cache') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{  Request::is('extra') ? 'text-white' : ' '}}">Clear Cache</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.extra.system.info') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title {{  Request::is('extra/system/info') ? 'text-white' : ' '}}">System Information</span>
                    </a>
                </li>
            </ul>

        </li>

    </ul>
    </li>
    </ul>
</div>
