<div class='header'>
    <div class='header__inner'>
        <div class='container'>
            <h1 class='branding'><a href="/">Deploy</a></h1>
            <nav class='main-menu'>
                <ul class='inline-list'>
                    <li class='inline-list__item <?php if($this->request['controller'] == 'pages') echo 'is-active'; ?> main-menu__item'>
                        <a class="main-menu__link" href="/">
                            <img alt="Dashboard Icon" class="main-menu__icon" src="/img/icons/icon-dashboard-b7fc48923a8411a5354a81b66e34b692.svg" />
                            <span class='main-menu__text'>Dashboard</span>
                        </a></li>
                    <li class='inline-list__item <?php if($this->request['controller'] == 'projects') echo 'is-active'; ?> main-menu__item'>
                        <a class="main-menu__link" href="/projects">
                            <img alt="Projects Icon" class="main-menu__icon" src="/img/icons/icon-projects-f2e21fdd8c1a0dfc1b7e438396263705.svg" />
                            <span class='main-menu__text'>Projects</span>
                        </a></li>
                    <li class='inline-list__item <?php if($this->request['controller'] == 'accounts') echo 'is-active'; ?> main-menu__item'>
                        <a class="main-menu__link" href="/account">
                            <img alt="Account icon" class="main-menu__icon" src="/img/icons/icon-accounts-5573fc3b8b4b9b204d48ac0d24eb1799.svg" />
                            <span class='main-menu__text'>Account</span>
                        </a></li>
                    <li class='inline-list__item <?php if($this->request['controller'] == 'users') echo 'is-active'; ?> main-menu__item'>
                        <a class="main-menu__link" href="/users">
                            <img alt="Users icon" class="main-menu__icon" src="/img/icons/icon-users-4d09e071ba1c6eed77353183a91a9e9c.svg" />
                            <span class='main-menu__text'>Users</span>
                        </a></li>
                </ul>
            </nav>
            <div class='user-menu'>
                <a class="js-toggle-nav" href="#" rel="nofollow">
                    <img alt="shukai zhao&#39;s Avatar" class="user-menu__icon avatar-image" src="/img/avatar.png" />
                </a>
            </div>
        </div>
    </div>
    <nav class='nav js-nav is-hidden'>
        <div class='nav__container container'>
            <div class='box box--heavy user-menu-block'>
                <ul class='block-list'>
                    <li class='block-list__item'>
                        <a class="block-list__link" href="/profile">Profile</a>
                    </li>
                    <li class='block-list__item'>
                        <a class="block-list__link" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
