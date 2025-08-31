<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo offset-2">
        <a href="javascript:void(0);" class="app-brand-link">
            {{-- <span class="app-brand-text demo menu-text fw-bolder ms-2">Blotter</span> --}}
            {{-- <img src="{{ asset('assets/img/Logo.png') }}" style="height: 50px"> --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">

        <!-- Dashboard -->
        <li class="menu-item @yield('dashboard')">
            <a href="{{route('admin.dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <!-- pages -->
        <li class="menu-item @yield('sale')">
            <a href="{{route('admin.sale')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Layouts">Sale Persons</div>
            </a>
        </li>
        <li class="menu-item @yield('client')">
            <a href="{{route('admin.client')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Layouts">Client Details</div>
            </a>
        </li>

        <li class="menu-item @yield('designer')">
            <a href="{{route('admin.designer')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Layouts">Designers</div>
            </a>
        </li>
        <li class="menu-item @yield('skype')">
            <a href="{{route('admin.skype')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Layouts">Skype Details</div>
            </a>
        </li>
        <li class="menu-item @yield('order')">
            <a href="{{route('admin.order')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Layouts">Orders</div>
            </a>
        </li>
        <li class="menu-item @yield('invoice')">
            <a href="{{route('admin.invoice')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Layouts">invoices</div>
            </a>
        </li>
        <li class="menu-item @yield('account')">
            <a href="{{route('admin.account')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Layouts">Gmail Accounts</div>
            </a>
        </li>
        <li class="menu-item @yield('filter')">
            <a href="{{route('admin.order.filter')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Layouts">Order Filter</div>
            </a>
        </li>
        <li class="menu-item @yield('monthly')">
            <a href="{{route('admin.monthly')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Layouts">Monthly Sale</div>
            </a>
        </li>
        <li class="menu-item @yield('paid')">
            <a href="{{route('admin.paid.invoice')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Layouts">Paid Invoices</div>
            </a>
        </li>
        <li class="menu-item @yield('download')">
            <a href="{{route('admin.download.invoice')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Layouts">Download Invoices</div>
            </a>
        </li>
        <li class="menu-item @yield('downloaded')">
            <a href="{{route('admin.downloaded.invoice')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Layouts">Downloaded</div>
            </a>
        </li>

    </ul>
</aside>
