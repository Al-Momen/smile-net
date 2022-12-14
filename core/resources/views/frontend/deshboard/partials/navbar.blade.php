<!-- navbar-wrapper-start -->
<nav class="navbar-wrapper">
    <div class="navbar-wrapper-area">
        <div class="dashboard-title-part">
            <h4 class="title">Dashboard</h4>
        </div>
        <div class="navbar__right ">
            <ul class="navbar__action-list" style="list-style: none;">
                <li class="dropdown">
                    <button type="button" class="" data-bs-toggle="dropdown" data-display="static"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="navbar-user">
                            <span class="navbar-user__thumb"><img
                                    src="assets/images/bookMagazine/user.jpg" alt="user"></span>
                            <span class="navbar-user__info">
                                <span class="navbar-user__name">User</span>
                            </span>
                            <span class="icon"><i class="las la-chevron-circle-down"></i></span>
                        </span>
                    </button>
                    <div
                        class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right">
                        <a href="user-profile.html"
                            class="dropdown-menu__item d-flex align-items-center ps-3 pe-3 pt-2 pb-2">
                            <i class="dropdown-menu__icon las la-user-circle"></i>
                            <span class="dropdown-menu__caption">Profile</span>
                        </a>
                        <a href="dashboard-password-reset.html"
                            class="dropdown-menu__item d-flex align-items-center ps-3 pe-3 pt-2 pb-2">
                            <i class="dropdown-menu__icon las la-key"></i>
                            <span class="dropdown-menu__caption">Password</span>
                        </a>
                        <a href="{{route('user.logout')}}"
                            class="dropdown-menu__item d-flex align-items-center ps-3 pe-3 pt-2 pb-2">
                            <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                            <span class="dropdown-menu__caption">Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>