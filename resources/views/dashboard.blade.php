@extends('layouts.master')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>DASHBOARD SDM</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/error">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Sales Card -->
                    <div class="col-md-12">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <section class="section dashboard">
                                    <div class="row">

                                        <!-- Left side columns -->
                                        <div class="col-lg-12 mt-4">
                                            <div class="row">

                                                <!-- ALL DATA -->
                                                <div class="col-xxl-3 col-md-6">
                                                    <div class="card info-card sales-card">
                                                        <div class="filter">
                                                            <a class="icon" data-bs-toggle="dropdown"><i
                                                                    class="bi bi-three-dots"></i></a>
                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                <li class="dropdown-header text-start">
                                                                    <h6>Filter</h6>
                                                                </li>
                                                                <li><a class="dropdown-item" href="/employee">Detail...</a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <a class="card-body" href="/employee">
                                                            <h5 class="card-title">ALL DATA <span>| Hari Ini</span></h5>

                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                                    <i class="bi bi-people"></i>
                                                                </div>
                                                                <div class="ps-3">
                                                                    <h6>{{ $allKaryawan }}</h6>
                                                                    {{-- <span class="text-success small pt-1 fw-bold">12%</span> --}}
                                                                    {{-- <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                                                </div>
                                                            </div>
                                                        </a>

                                                    </div>
                                                </div><!-- End ALL DATA -->

                                                <!-- GOLREG -->
                                                <div class="col-xxl-3 col-md-6">
                                                    <div class="card info-card revenue-card">

                                                        <div class="filter">
                                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                                    class="bi bi-three-dots"></i></a>
                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                <li class="dropdown-header text-start">
                                                                    <h6>Filter</h6>
                                                                </li>
                                                                <li><a class="dropdown-item" href="/book">Detail...</a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <a class="card-body" href="/book">
                                                            <h5 class="card-title">GOLREG <span>| Setiap 4 Tahun</span></h5>

                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                                    <i class="bi bi-people"></i>
                                                                </div>
                                                                <div class="ps-3">
                                                                    <h6>{{ $golReg }}</h6>
                                                                    {{-- <span class="text-success small pt-1 fw-bold">8%</span>
                                                                    <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div><!-- End GOREG -->
                                                {{-- dashboard --}}

                                                <!-- ALL GOLPIL -->
                                                <div class="col-xxl-3 col-md-6">

                                                    <div class="card info-card customers-card">

                                                        <div class="filter">
                                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                                    class="bi bi-three-dots"></i></a>
                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                <li class="dropdown-header text-start">
                                                                    <h6>Filter</h6>
                                                                </li>
                                                                <li><a class="dropdown-item" href="/pilihan">Detail...</a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <a class="card-body" href="/pilihan">
                                                            <h5 class="card-title">GOLPIL <span>| Setiap 1 Tahun</span></h5>

                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                                    <i class="bi bi-people"></i>
                                                                </div>
                                                                <div class="ps-3">
                                                                    <h6>{{ $golPil }}</h6>
                                                                    {{-- <span class="text-danger small pt-1 fw-bold">12%</span>
                                                                    <span class="text-muted small pt-2 ps-1">decrease</span> --}}

                                                                </div>
                                                            </div>

                                                        </a>
                                                    </div>

                                                </div><!-- End GOLPIL -->

                                                <div class="col-xxl-3 col-md-6">

                                                    <div class="card info-card customers-card">

                                                        <div class="filter">
                                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                                    class="bi bi-three-dots"></i></a>
                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                <li class="dropdown-header text-start">
                                                                    <h6>Filter</h6>
                                                                </li>
                                                                <li><a class="dropdown-item" href="/pkwt">Detail...</a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <a class="card-body" href="/pkwt">
                                                            <h5 class="card-title">PKWT <span>| Setiap 1 Tahun</span></h5>

                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                                    <i class="bi bi-people"></i>
                                                                </div>
                                                                <div class="ps-3">
                                                                    <h6>{{ $pkwt }}</h6>
                                                                    {{-- <span class="text-danger small pt-1 fw-bold">12%</span>
                                                                    <span class="text-muted small pt-2 ps-1">decrease</span> --}}

                                                                </div>
                                                            </div>

                                                        </a>
                                                    </div>

                                                </div><!-- End GOLPIL -->
                                                <div class="col-xxl-3 col-md-6">

                                                    <div class="card info-card customers-card">

                                                        <div class="filter">
                                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                                    class="bi bi-three-dots"></i></a>
                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                <li class="dropdown-header text-start">
                                                                    <h6>Filter</h6>
                                                                </li>
                                                                <li><a class="dropdown-item" href="/histroy">Detail...</a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <a class="card-body" href="/histroy">
                                                            <h5 class="card-title">Riwayat Hold <span>| Tunggu Dari
                                                                    Atasan</span></h5>

                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                                    <i class="bi bi-people"></i>
                                                                </div>
                                                                <div class="ps-3">
                                                                    <h6>{{ $hold }}</h6>
                                                                    {{-- <span class="text-danger small pt-1 fw-bold">12%</span>
                                                                    <span class="text-muted small pt-2 ps-1">decrease</span> --}}

                                                                </div>
                                                            </div>

                                                        </a>
                                                    </div>

                                                </div><!-- End GOLPIL -->


                                                <!-- Recent Sales -->
                                                <div class="col-12">
                                                    <div class="card recent-sales overflow-auto">

                                                        <div class="filter">
                                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                                    class="bi bi-three-dots"></i></a>
                                                            <br>
                                                            <ul
                                                                class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                <li class="dropdown-header text-start">
                                                                    <h6>Filter</h6>
                                                                </li>
                                                                <li><a class="dropdown-item" href="/pensiun">Pensiun</a>
                                                                <li><a class="dropdown-item" href="/pkwt">PKWT</a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="card-body">
                                                            <a href="/pensiun" class="card-title">All Retirement Data
                                                                <span>| 12 Bulan & 6 Bulan</span>
                                                            </a>
                                                            <br>
                                                            <br>

                                                            <table class="table table-borderless datatable">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">No</th>
                                                                        <th scope="col">NIK</th>
                                                                        <th scope="col">NAMA LENGKAP</th>
                                                                        <th scope="col">JABATAN</th>
                                                                        <th scope="col">TANGGAL LAHIR</th>
                                                                        <th scope="col">CALON KARYAWAN</th>
                                                                        <th scope="col">12 BULAN</th>
                                                                        <th scope="col">6 BULAN</th>
                                                                        <th scope="col">TMT PENSIUN</th>
                                                                        <th scope="col">STATUS</th>
                                                                    </tr>
                                                                </thead>
                                                                @php
                                                                    $no = 1;
                                                                @endphp
                                                                <tbody>
                                                                    @foreach ($karyawan as $b)
                                                                        <tr>
                                                                            <td class="ps-3">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $no++ }}</p>
                                                                            </td>
                                                                            <td class="#">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $b->nik }}</p>
                                                                            </td>
                                                                            <td class="#">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $b->name }}</p>
                                                                            </td>
                                                                            <td class="#">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $b->jabatan }}</p>
                                                                            </td>
                                                                            <td class="#">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{-- {{ $b->tgl_lahir }} --}}
                                                                                    {{ Carbon\Carbon::parse($b->tgl_lahir)->translatedFormat('d M Y') }}
                                                                                </p>
                                                                            </td>
                                                                            <td class="#">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ Carbon\Carbon::parse($b->cakar)->translatedFormat('d M Y') }}
                                                                                    {{-- {{ $b->cakar }} --}}
                                                                                </p>
                                                                            </td>
                                                                            <td class="#">
                                                                                @if ($b->pilihan_pensiun == 12)
                                                                                    {{ Carbon\Carbon::parse($b->tgl_lahir . ' +55years')->translatedFormat('d M Y') }}
                                                                                    {{-- {{ date('Y-m-d', strtotime($b->tgl_lahir . ' +55years')) }} --}}
                                                                                @else
                                                                                    <span class="badge bg-warning">Already
                                                                                        Selected</span>
                                                                                @endif
                                                                            </td>
                                                                            <td class="#">
                                                                                @if ($b->pilihan_pensiun == 6)
                                                                                    {{-- {{ date('Y-m-d', strtotime($b->tgl_lahir . ' +55years +6months')) }} --}}
                                                                                    {{ Carbon\Carbon::parse($b->tgl_lahir . ' +55years +6months')->translatedFormat('d M Y') }}
                                                                                    {{-- {{ date('Y-m-d', strtotime($b->tgl_lahir . ' +55years')) }} --}}
                                                                                @else
                                                                                    <span class="badge bg-warning">Already
                                                                                        Selected</span>
                                                                                @endif
                                                                            </td>
                                                                            <td class="#">
                                                                                {{ Carbon\Carbon::parse($b->tgl_lahir . ' +56years')->translatedFormat('d M Y') }}
                                                                                {{-- {{ date('Y-m-d', strtotime($b->tgl_lahir . ' +56years')) }} --}}
                                                                            </td>
                                                                            <td><span
                                                                                    class="badge bg-success">Approved</span>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>



                                                        {{-- bagian di hold --}}
                                                        <div class="card-body">
                                                            <a href="/hold" class="card-title">All Data Hold <span>|
                                                                    Karyawan DiHold
                                                                </span>
                                                            </a>
                                                            <br>
                                                            <br>
                                                            <table class="table table-borderless datatable">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">No</th>
                                                                        <th scope="col">NIK</th>
                                                                        <th scope="col">NAMA LENGKAP</th>
                                                                        <th scope="col">JABATAN</th>
                                                                        <th scope="col">GOLONGAN SAAT INI</th>
                                                                        <th scope="col">TMT GOLONGAN SAAT INI</th>
                                                                        <th scope="col">GOLONGAN MENDATANG</th>
                                                                        <th scope="col">TMT GOLONGAN MENDATANG</th>
                                                                        <th scope="col">ESELON</th>
                                                                        <th scope="col">TMT ESELON</th>
                                                                        <th scope="col">STATUS KENAIKAN</th>
                                                                        <th scope="col">STATUS</th>
                                                                        <th scope="col">KETERANGAN</th>
                                                                    </tr>
                                                                </thead>
                                                                @php
                                                                    $no = 1;
                                                                @endphp
                                                                <tbody>
                                                                    @foreach ($book as $b)
                                                                        <tr>
                                                                            <td class="ps-4">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $no++ }}</p>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $b->karyawan->nik }}
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $b->karyawan->name }}</p>
                                                                            </td>
                                                                            <td>
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $b->karyawan->jabatan }}</p>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $b->golonganini }}
                                                                                </p>
                                                                            </td>
                                                                            <td class="#">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ Carbon\Carbon::parse($b->tmt_golonganini)->translatedFormat('d M Y') }}
                                                                                    {{-- {{ $b->tmt_golonganini }} --}}
                                                                                </p>
                                                                            </td>

                                                                            <td class="text-center">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $b->golongan }}</p>
                                                                            </td>

                                                                            <td class="text-center">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ Carbon\Carbon::parse($b->tmt_golongan)->translatedFormat('d M Y') }}
                                                                                    {{-- {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y', strtotime($b->tmt_golongan)) }} --}}
                                                                                </p>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $b->eselon }}</p>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ Carbon\Carbon::parse($b->tmt_eselon)->translatedFormat('d M Y') }}
                                                                                    {{-- {{ $b->tmt_eselon }} --}}
                                                                                </p>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                @if ($b->is_pilihan)
                                                                                    <a class="badge bg-success"
                                                                                        href="/pilihan">Pilihan</a>
                                                                                @else
                                                                                    <a class="badge bg-info"
                                                                                        href="/book">Reguler</a>
                                                                                @endif
                                                                            </td>
                                                                            <td><a href="/hold"
                                                                                    class="badge bg-warning">Hold</a>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $b->lastKenaikanTingkat ? $b->lastKenaikanTingkat->keterangan : '' }}
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div><!-- End Recent Sales -->
                                            </div>
                                        </div><!-- End Left side columns -->

                                        <center>
                                            <h1 class="card-title" style="margin-bottom: -25px;">WELCOME TO PT DOK DAN
                                                PERKAPALAN
                                                AIR KANTUNG</h1>
                                            <h1 class="card-title" style="margin-bottom: -25px;">YOUTUBE<a
                                                    href="https://www.youtube.com/channel/UCC-gyQvScZ2KTGtTP1QbmkQ">
                                                    MORE ...</a>
                                            </h1>
                                        </center>
                                    </div>
                            </div>
                        </div><!-- End Sales Card -->
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@section('sweetalert')
    <script>
        swal("Welcome Insan PT DOK DAN PERKAPALAN AIR KANTUNG");
    </script>
@endsection
