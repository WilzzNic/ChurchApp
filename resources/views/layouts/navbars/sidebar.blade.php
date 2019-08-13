<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('img') }}/logo_indigo.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            @if(auth()->user()->jemaat->jenis_kelamin == 'L')
                            <img src="{{ asset('img') }}/icons8-user-64.png" alt="Image placeholder"
                                style="background-color:white;">
                            @else
                            <img src="{{ asset('img') }}/icons8-female-user-64.png" alt="Image placeholder"
                                style="background-color:white;">
                            @endif
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('img') }}/logo_indigo.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            {{-- <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                        placeholder="{{ __('Search') }}" aria-label="Search">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-search"></span>
                </div>
            </div>
        </div>
        </form> --}}
        <!-- Navigation -->
        <h6 class="navbar-heading text-muted">Personal</h6>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.edit') }}">
                    <i class="fa fa-user text-primary"></i> {{ __('General Description') }}
                </a>
            </li>
        </ul>

        @if(Auth::user()->can('superadmin'))
        <hr class="my-3">

        <h6 class="navbar-heading text-muted">Menus</h6>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('superadmin.manage.daerah') }}">
                    <i class="ni ni-map-big text-default"></i> {{ __('Manajemen Data Daerah') }}
                </a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('superadmin.manage.cabang') }}">
                    <i class="ni ni-square-pin text-default"></i> {{ __('Manajemen Cabang Gereja') }}
                </a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('superadmin.manage.admin') }}">
                    <i class="ni ni-circle-08 text-default"></i> {{ __('Manajemen Admin') }}
                </a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('superadmin.statistic.index') }}">
                    <i class="ni ni-chart-bar-32 text-default"></i> {{ __('Statistik dan Data') }}
                </a>
            </li>
        </ul>
        @endif

        @if(Auth::user()->can('admin'))
        <hr class="my-3">

        <h6 class="navbar-heading text-muted">Menus</h6>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.manage.leader.index') }}">
                    <i class="fa fa-users text-default"></i> {{ __('Manajemen Pimpinan') }}
                </a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.manage.fa.index') }}">
                    <i class="fa fa-users text-default"></i> {{ __('Manajemen Family Altar') }}
                </a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#navbar-verifikasi" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="navbar-verifikasi">
                    <i class="ni ni-paper-diploma text-default"></i>
                    <span class="nav-link-text text-default">{{ __('Verifikasi') }}</span>
                </a>

                <div class="collapse show" id="navbar-verifikasi">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.manage.baptis.index') }}">
                                {{ __('Sertifikat Baptis') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.manage.kom.index') }}">
                                {{ __('Sertifikat KOM') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.manage.kaj.index') }}">
                                {{ __('Sertifikat KAJ') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.manage.jemaat.index') }}">
                                {{ __('Jemaat') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        @endif

        @if(Auth::user()->can('FA_leader') || Auth::user()->can('baptis_leader') || Auth::user()->can('KOM_leader')
        || Auth::user()->can('KAJ_leader'))
        <hr class="my-3">

        <h6 class="navbar-heading text-muted">Menus</h6>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#navbar-inbox" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="navbar-inbox">
                    <i class="fa fa-inbox text-default"></i>
                    {{ __('Inbox Jemaat') }}</span>
                </a>

                <div class="collapse show" id="navbar-inbox">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('leader.request.show') }}">
                                <i class="fa fa-paper-plane text-default"></i> {{ __('Request List') }}
                            </a>
                        </li>

                        @if(auth()->user()->role == 'KOM_leader')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('leader.kom.enrolling.index') }}">
                                <i class="ni ni-bus-front-12 text-default"></i> Enrolling List
                            </a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('leader.request.approved.index') }}">
                                @if(auth()->user()->role == 'KOM_leader')
                                <i class="fa fa-clipboard-list text-default"></i>
                                Completed List
                                @else
                                <i class="fa fa-envelope-open text-default"></i>
                                Approved List
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('leader.statistic.index') }}">
                    <i class="ni ni-chart-bar-32 text-default"></i> {{ __('Statistik dan Data') }}
                </a>
            </li>
        </ul>
        @endif

        @if(Auth::user()->can('KOM_leader'))
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#navbar-inbox-guest" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="navbar-inbox">
                    <i class="fa fa-inbox text-default"></i>
                    {{ __('Inbox Guest') }}</span>
                </a>

                <div class="collapse show" id="navbar-inbox-guest">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('leader.guest.request.pending.index') }}">
                                <i class="fa fa-paper-plane text-default"></i> {{ __('Request List') }}
                            </a>
                        </li>

                        @if(auth()->user()->role == 'KOM_leader')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('leader.guest.kom.enrolling.index') }}">
                                <i class="ni ni-bus-front-12 text-default"></i> Enrolling List
                            </a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('leader.guest.kom.completed.index') }}">
                                <i class="fa fa-clipboard-list text-default"></i>
                                Completed List
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('leader.kom.jadwal.index') }}">
                    <i class="fa fa-clock text-default"></i> {{ __('Manajemen Jadwal KOM') }}
                </a>
            </li>
        </ul>
        @endif

        @unless(Auth::user()->can('guest') || Auth::user()->can('admin') || Auth::user()->can('superadmin') ||
        Auth::user()->can('KAJ_leader') || Auth::user()->can('KOM_leader') || Auth::user()->can('baptis_leader'))
        <hr class="my-3">

        <h6 class="navbar-heading text-muted">Services</h6>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#navbar-baptis" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="navbar-baptis">
                    <i class="fa fa-tint" style="color: #f4645f;"></i>
                    <span class="nav-link-text" style="color: #f4645f;">{{ __('Pelayanan Baptis') }}</span>
                </a>

                <div class="collapse show" id="navbar-baptis">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bcon.requestbaptis') }}">
                                {{ __('Daftar Pelayanan Baptisan') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#navbar-kom" data-toggle="collapse" role="button" aria-expanded="true"
                    aria-controls="navbar-kom">
                    <i class="ni ni-hat-3" style="color: #f4645f;"></i>
                    <span class="nav-link-text" style="color: #f4645f;">{{ __('Pelayanan KOM') }}</span>
                </a>

                <div class="collapse show" id="navbar-kom">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bcon.requestkom') }}">
                                {{ __('Daftar Pelayanan KOM') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#navbar-kaj" data-toggle="collapse" role="button" aria-expanded="true"
                    aria-controls="navbar-kaj">
                    <i class="ni ni-badge" style="color: #f4645f;"></i>
                    <span class="nav-link-text" style="color: #f4645f;">{{ __('Pelayanan KAJ') }}</span>
                </a>

                <div class="collapse show" id="navbar-kaj">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bcon.requestkaj') }}">
                                {{ __('Daftar Pelayanan KAJ') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        @unless(Auth::user()->can('FA_leader'))
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('bcon.requestfa') }}">
                    <i class="fa fa-users text-primary"></i> {{ __('Family Altar') }}
                </a>
            </li>
        </ul>
        @endunless
        @endunless

        {{-- <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
        </a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true"
                aria-controls="navbar-examples">
                <i class="fab fa-laravel" style="color: #f4645f;"></i>
                <span class="nav-link-text" style="color: #f4645f;">{{ __('Laravel Examples') }}</span>
            </a>

            <div class="collapse show" id="navbar-examples">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">
                            {{ __('User profile') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            {{ __('User Management') }}
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="ni ni-planet text-blue"></i> {{ __('Icons') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="ni ni-pin-3 text-orange"></i> {{ __('Maps') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="ni ni-key-25 text-info"></i> {{ __('Login') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="ni ni-circle-08 text-pink"></i> {{ __('Register') }}
            </a>
        </li>
        <li class="nav-item mb-5" style="position: absolute; bottom: 0;">
            <a class="nav-link" href="https://www.creative-tim.com/product/argon-dashboard-pro-laravel" target="_blank">
                <i class="ni ni-cloud-download-95"></i> Upgrade to PRO
            </a>
        </li>
        </ul> --}}
    </div>
    </div>
</nav>