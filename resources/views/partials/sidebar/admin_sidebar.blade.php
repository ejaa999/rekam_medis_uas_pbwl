<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    @include('partials.sidebar_logo')

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ url('/') == url()->current() ? 'active' : '' }}">
            <a href="/" class="menu-link">
                {{-- <i class="fa-solid fa-house fa-lg"></i> --}}
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Akun -->
        <li class="menu-item {{ strpos(url()->current(), 'akun') != false ? 'active' : '' }}">
            <a href="/akun" class="menu-link">
                {{-- <i class="fa-solid fa-circle-user fa-lg"></i> --}}
                <div data-i18n="Analytics">Akun</div>
            </a>
        </li>

        <!-- Faskes -->
        <li class="menu-item {{ strpos(url()->current(), 'faskes') != false ? 'active' : '' }}">
            <a href="/faskes" class="menu-link">
                <div data-i18n="Analytics">Faskes</div>
            </a>
        </li>

    </ul>
</aside>
<!-- / Menu -->
