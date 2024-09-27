<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Menu Master</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/employee">
                        <i class="bi bi-circle"></i><span>All Data</span>
                    </a>
                    <a href="/book">
                        <i class="bi bi-circle"></i><span>GolReg</span>
                    </a>
                    <a href="/pilihan">
                        <i class="bi bi-circle"></i><span>GolPil</span>
                    </a>
                    <a href="/pkwt">
                        <i class="bi bi-circle"></i><span>PKWT Dan Tenaga Ahli</span>
                    </a>
                    <a href="/karyawan">
                        <i class="bi bi-circle"></i><span>PKWTT</span>
                    </a>
                    <a href="/pensiun">
                        <i class="bi bi-circle"></i><span>MPP</span>
                    </a>

                </li>
            </ul>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Hold Employee</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/hold">
                        <i class="bi bi-circle"></i><span>HOLD ON</span>
                    </a>
                    <a href="/histroy">
                        <i class="bi bi-circle"></i><span>HISTORY</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Icons Nav -->

        <li class="nav-heading">Setting</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Roles</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/eselon">
                        <i class="bi bi-circle"></i><span>Eselon</span>
                    </a>
                </li>
                <li>
                    <a href="/profile">
                        <i class="bi bi-circle"></i><span>User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kategorikontrak.index') }}">
                        <i class="bi bi-circle"></i><span>Kategori Kontrak</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->


        <li class="nav-heading">Logout</li>


        <div class="dropdown-item d-flex align-items-center">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="nav-link bg-white border-0"><i class="bi bi-box-arrow-left"></i>
                    Sign Out<span data-feather="log-out "></span>
                </button>
            </form>
        </div>


        {{-- <li class="nav-heading">Mode - Devlop</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-cpu"></i><span>Devlop WEB</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/e-mail">
                        <i class="bi bi-circle"></i><span>EMAIL DESAIN</span>
                    </a>
                </li>
            </ul>
        </li> --}}
    </ul>
</aside><!-- End Sidebar-->
