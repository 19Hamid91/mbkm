<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @if (Auth::user()->role!="MHS")
             <li
            class="nav-item {{ Request::is('/') || Request::is('kaprodi')|| Request::is('dosbing') || Request::is('kajur') || Request::is('pimpinan')|| Request::is('pemlap') || Request::is('admin') || Request::is('pic') ? 'active' : '' }}">
            <a class="nav-link "
                href="@if (Auth::user()->role=="MHS") /
            @elseif(Auth::user()->role=="KAPRODI")
                /kaprodi
            @elseif (Auth::user()->role=="KAJUR")
                /kajur
            @elseif(Auth::user()->role=="PIMPINAN")
                /pimpinan
            @elseif(Auth::user()->role=="DOSEN")
                /dosbing
            @elseif(Auth::user()->role=="PEMLAP")
                /pemlap
            @elseif(Auth::user()->role=="ADMIN")
                /admin
            @elseif(Auth::user()->role=="BAKPK")
                /bakpk 
            @elseif(Auth::user()->role=="PIC")
                /pic
                @endif">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @endif
       
        @if (Auth::user()->role == 'MHS')
            {{-- <li
                class="nav-item {{ Request::is('mbkm/out')|| Request::is('mbkm/support/*') || Request::is('mbkm/regis') || Request::is('mbkm/in') ? 'active' : '' }}">
                <a class="nav-link " data-toggle="collapse" href="#ui-basic"
                    aria-expanded="{{ Request::is('mbkm/in')|| Request::is('mbkm/support/*') || Request::is('mbkm/regis') || Request::is('mbkm/out') ? 'true' : 'false' }}"
                    aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">MBKM</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse {{ Request::is('mbkm/in') || Request::is('mbkm/out') || Request::is('mbkm/regis') || Request::is('mbkm/support/*') ? 'show' : '' }}"
                    id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        {{-- <li class="nav-item {{ Request::is('mbkm/out') ? '' : 'active' }}"> <a class="nav-link "
                                href="/mbkm/out">Luar Polines</a></li> --}}
                        {{-- <li
                            class="nav-item {{ Request::is('mbkm/in') || Request::is('mbkm/support/*') || Request::is('mbkm/regis') ? '' : 'active' }}">
                            <a class="nav-link" href="/mbkm/in">Luar Polines
                            </a>
                        </li>
                    </ul>
                </div>
            </li>  --}}
            <li class="nav-item {{ Request::is('mbkm/out')|| Request::is('mbkm/support/*') || Request::is('mbkm/regis') || Request::is('mbkm/in') ? 'active' : '' }}">
                <a class="nav-link " href="/mbkm/in">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">MBKM</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('logbook') ? 'active' : '' }}">
                <a class="nav-link " href="/logbook">
                    <i class="ti-book menu-icon"></i>
                    <span class="menu-title">Dokumen</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('history') ? 'active' : '' }}">
                <a class="nav-link " href="/history">
                    <i class="ti-book menu-icon"></i>
                    <span class="menu-title">History</span>
                </a>
            </li>
        @elseif(Auth::user()->role=="DOSEN" || Auth::user()->role=="PEMLAP")
            <li class="nav-item {{ Request::is('dosbing/logbook')||Request::is('pemlap/logbook') ? 'active' : '' }}">
                <a class="nav-link " href="{{ (Auth::user()->role=="DOSEN")?'/dosbing/logbook':'/pemlap/logbook' }}">
                    <i class="ti-book menu-icon"></i>
                    <span class="menu-title">Logbook</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('dosbing/report') ||Request::is('pemlap/report') ? 'active' : '' }}">
                <a class="nav-link " href="{{ (Auth::user()->role=="DOSEN")?'/dosbing/report':'/pemlap/report' }}">
                    <i class="ti-package menu-icon"></i>
                    <span class="menu-title">Laporan</span>
                </a>
            </li>
        @elseif(Auth::user()->role=="ADMIN")
            <li class="nav-item {{ Request::is('admin/dosens') ? 'active' : '' }}">
                <a class="nav-link " href="/admin/dosens">
                    <i class="ti-book menu-icon"></i>
                    <span class="menu-title">Dosen</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/pic') ? 'active' : '' }}">
                <a class="nav-link " href="/admin/pic">
                    <i class="ti-book menu-icon"></i>
                    <span class="menu-title">PIC</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/jurusan') ? 'active' : '' }}">
                <a class="nav-link " href="/admin/jurusan">
                    <i class="ti-book menu-icon"></i>
                    <span class="menu-title">Jurusan</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/prodi') ? 'active' : '' }}">
                <a class="nav-link " href="/admin/prodi">
                    <i class="ti-book menu-icon"></i>
                    <span class="menu-title">Prodi</span>
                </a>
            </li>
        @elseif(Auth::user()->role=="PIMPINAN")
            <li class="nav-item {{ Request::is('pimpinan/data') ? 'active' : '' }}">
                <a class="nav-link " href="/pimpinan/data">
                    <i class="ti-book menu-icon"></i>
                    <span class="menu-title">Data Mahasiswa</span>
                </a>
            </li>
        @endif

        {{-- <li class="nav-item">
        <a class="nav-link" href="pages/documentation/documentation.html">
            <i class="icon-paper menu-icon"></i>
            <span class="menu-title">Documentation</span>
        </a>
    </li> --}}
    </ul>
</nav>
