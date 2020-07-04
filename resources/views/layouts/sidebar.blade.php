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
                <li{{ Request::is('dashboard') ? ' class=selected' : '' }}>
                    <a class="waves-effect waves-dark" href="{{ route('home') }}" aria-expanded="false">
                        <i class="ti-panel"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li{{ Request::is('penilaian-pegawai*') ? ' class=selected' : '' }}>
                    <a class="waves-effect waves-dark" href="{{ route('penilaian-pegawai.index') }}" aria-expanded="false">
                        <i class="ti-bar-chart"></i>
                        <span class="hide-menu">Penilaian Pegawai</span>
                    </a>
                </li>
                @can('tambah penilaian komite')
                    <li{{ Request::is('penilaian-komite*') ? ' class=selected' : '' }}>
                        <a class="waves-effect waves-dark" href="{{ route('penilaian-komite.index') }}" aria-expanded="false">
                            <i class="ti-bar-chart-alt"></i>
                            <span class="hide-menu">Penilaian Komite</span>
                        </a>
                    </li>
                @endcan
                <li{{ Request::is( 'pegawai*') ? ' class=selected' : '' }}>
                    <a class="waves-effect waves-dark" href="{{ route('pegawai.index') }}" aria-expanded="false">
                        <i class="ti-user"></i>
                        <span class="hide-menu">Data Pegawai</span>
                    </a>
                </li>
                <hr>
                <li{{ Request::is( 'master/*') ? ' class=selected' : '' }}>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="ti-settings"></i> <span class="hide-menu"> Master Data</span>
                    </a>
                    <ul aria-expanded="false" class="collapse{{ Request::is( 'master/*') ? ' in' : '' }}">
                        @can('master aspek')
                            <li>
                                <a class="waves-effect waves-dark{{ Request::is( 'master/aspek-penilaian*') ? ' active' : '' }}" href="{{ route('aspek.index') }}" aria-expanded="false">
                                    <i class="ti-agenda"></i>
                                    <span class="hide-menu">Aspek Penilaian</span>
                                </a>
                            </li>
                            <li>
                                <a class="waves-effect waves-dark{{ Request::is( 'master/aspek-komite*') ? ' active' : '' }}" href="{{ route('aspek-komite.index') }}" aria-expanded="false">
                                    <i class="ti-receipt"></i>
                                    <span class="hide-menu">Aspek Komite</span>
                                </a>
                            </li>
                        @endcan
                        @can('master aspek')
                            <li>
                                <a class="waves-effect waves-dark{{ Request::is( 'master/user*') ? ' active' : '' }}" href="{{ route('user.index') }}" aria-expanded="false">
                                    <i class="ti ti-id-badge"></i>
                                    <span class="hide-menu">User Account</span>
                                </a>
                            </li>
                        @endcan
                        @can('master group')
                            <li>
                                <a class="waves-effect waves-dark{{ Request::is( 'master/group*') ? ' active' : '' }}" href="{{ route('role.index') }}" aria-expanded="false">
                                    <i class="ti ti-menu-alt"></i>
                                    <span class="hide-menu">Group/Unit</span>
                                </a>
                            </li>
                        @endcan
                        @can('master bagian')
                            <li>
                                <a class="waves-effect waves-dark{{ Request::is( 'master/bagian*') ? ' active' : '' }}" href="{{ route('bagian.index') }}" aria-expanded="false">
                                    <i class="ti ti-layout-column3"></i>
                                    <span class="hide-menu">Bagian</span>
                                </a>
                            </li>
                        @endcan
                        @can('master komite')
                            <li>
                                <a class="waves-effect waves-dark{{ Request::is( 'master/komite*') ? ' active' : '' }}" href="{{ route('komite.index') }}" aria-expanded="false">
                                    <i class="ti ti-write"></i>
                                    <span class="hide-menu">Komite</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
