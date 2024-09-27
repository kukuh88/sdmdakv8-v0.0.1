@extends('layouts.master')

@section('page-title', 'ALL HOLD ON')

@section('breadcrumbs')
    <li class="breadcrumb-item">Hold Employee</li>
    <li class="breadcrumb-item active">Hold On</li>
@endsection

@section('style_css')
    <style>
        .table-responsive {
            font-size: .8em !important;
        }

        div.dataTables_processing {
            z-index: 1;
        }
    </style>
@endsection

@section('content')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">All History Hold</h5>
                            </div>

                            <div class="col-6">
                                <div class="right float-end">
                                    {{-- <button type="button" class="btn btn-primary" style="margin-top: 12px;"
                                            data-bs-toggle="modal" data-bs-target="#basicModal">
                                            Add Employee Class
                                        </button> --}}
                                    <a type="button" class="btn btn-outline-primary" style="margin-top: 12px;"
                                        href="/karyawan">
                                        Back
                                    </a>
                                </div>
                                <!-- Basic Modal -->
                            </div>
                        </div>
                        <!-- Table with hoverable rows -->
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <table class="table table-hover" id="datatable">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    NO
                                                </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    NIK</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    NAMA LENGKAP</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    JABATAN</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    GOLONGAN SAAT INI </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    TMT GOLONGAN </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    GOLONGAN MENDATANG </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    TMT GOLONGAN MENDATANG </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    ESLON</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    TMT ESLON</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Keterangan Hold</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    PENSIUN</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    STATUS</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        <tbody>
                                            @foreach ($book as $b)
                                                @if ($b->lastKenaikanTingkat ? $b->lastKenaikanTingkat->keterangan : '')
                                                    <tr>
                                                        <td class="ps-4">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $no++ }}
                                                            </p>
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
                                                                {{ Carbon\Carbon::parse($b->tmt_golonganini)->translatedFormat('d F Y') }}
                                                                {{-- {{ $b->tmt_golonganini }} --}}
                                                            </p>
                                                        </td>

                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $b->golongan }}
                                                            </p>
                                                        </td>

                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ Carbon\Carbon::parse($b->tmt_golongan)->translatedFormat('d F Y') }}
                                                                {{-- {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y', strtotime($b->tmt_golongan)) }} --}}
                                                            </p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $b->eselon }}
                                                            </p>
                                                        </td>

                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ Carbon\Carbon::parse($b->tmt_eselon)->translatedFormat('d F Y') }}
                                                                {{-- {{ $b->tmt_eselon }} --}}
                                                            </p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $b->lastKenaikanTingkat ? $b->lastKenaikanTingkat->keterangan : '' }}
                                                            </p>
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($b->is_pilihan)
                                                                <span class="badge rounded-pill bg-success">Aktif</span>
                                                            @else
                                                                <span class="badge rounded-pill bg-success">Aktif</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($b->is_pilihan)
                                                                <a class="badge rounded-pill bg-success"
                                                                    href="/pilihan">Pilihan</a>
                                                            @else
                                                                <a class="badge rounded-pill bg-info"
                                                                    href="/book">Reguler</a>
                                                            @endif
                                                        </td>

                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- End Table with hoverable rows -->
                            </div>
                        </div>
                    </div>
                </div>
    </section>
@endsection
@section('script_js')
    <script>
        var table = jQuery('#datatable').DataTable({

        });
    </script>

@endsection
