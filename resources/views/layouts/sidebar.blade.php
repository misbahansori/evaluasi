<aside class="left-sidebar">
    <div class="d-flex no-block nav-text-box align-items-center">
        <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)">
            <i class="ti-menu"></i>
        </a>
        <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)">
            <i class="ti-menu ti-close"></i>
        </a>
    </div>
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li{{ Request::is( 'dashboard') ? ' class=selected' : '' }}>
                    <a class="waves-effect waves-dark" href="{{ route('home') }}" aria-expanded="false">
                        <i class="ti-panel"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li{{ Request::is( 'pegawai*') ? ' class=selected' : '' }}>
                    <a class="waves-effect waves-dark" href="{{ route('pegawai.index') }}" aria-expanded="false">
                        <i class="ti-user"></i>
                        <span class="hide-menu">Data Pegawai</span>
                    </a>
                </li>
                <hr>
                <li{{ Request::is( 'master/aspek*') ? ' class=selected' : '' }}>
                    <a class="waves-effect waves-dark" href="{{ route('aspek.index') }}" aria-expanded="false">
                        <i class="ti-agenda"></i>
                        <span class="hide-menu">Master Aspek Penilaian</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
