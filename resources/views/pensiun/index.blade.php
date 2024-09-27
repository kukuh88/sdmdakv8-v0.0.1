@extends('layouts.master')

@section('page-title', 'ALL PKWT')

@section('breadcrumbs')
    <li class="breadcrumb-item">Data Master</li>
    <li class="breadcrumb-item active">PKWT</li>
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
                                <h5 class="card-title">Pension</h5>

                            </div>
                            <div class="col-6">
                                <div class="right float-end">
                                    <a type="button" class="btn btn-outline-primary" style="margin-top: 12px;"
                                        href="/dashboard">
                                        Back
                                    </a>

                                </div>
                                <!-- Basic Modal -->
                            </div>
                        </div>
                        <!-- Table with hoverable rows -->
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table table-hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                                TANGGAL LAHIR</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                CALON KARYAWAN </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                12 BULAN </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                6 BULAN </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                HABIS MASA KERJA 56 TAHUN</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                STATUS</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tbody>
                                        @foreach ($karyawan as $b)
                                            <tr>
                                                <td class="ps-3">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $no++ }}
                                                    </p>
                                                </td>
                                                <td class="#">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $b->nik }}
                                                    </p>
                                                </td>
                                                <td class="#">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $b->name }}
                                                    </p>
                                                </td>
                                                <td class="#">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $b->jabatan }}
                                                    </p>
                                                </td>
                                                <td class="#">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{-- {{ $b->tgl_lahir }} --}}
                                                        {{ Carbon\Carbon::parse($b->tgl_lahir)->translatedFormat('d M Y') }}
                                                    </p>
                                                </td>
                                                <td class="">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ Carbon\Carbon::parse($b->cakar)->translatedFormat('d M Y') }}
                                                        {{-- {{ $b->cakar }} --}}
                                                    </p>
                                                </td>
                                                <td class="text-xs font-weight-bold mb-0">
                                                    @if ($b->pilihan_pensiun == 12)
                                                        {{ Carbon\Carbon::parse($b->tgl_lahir . ' +55years')->translatedFormat('d M Y') }}
                                                        {{-- {{ date('Y-m-d', strtotime($b->tgl_lahir . ' +55years')) }} --}}
                                                    @else
                                                        <span class="badge bg-warning">Sorry
                                                            It's Already On
                                                            select
                                                            Which From Previous Form</span>
                                                    @endif
                                                </td>
                                                <td class="text-xs font-weight-bold mb-0">

                                                    @if ($b->pilihan_pensiun == 6)
                                                        {{ Carbon\Carbon::parse($b->tgl_lahir . ' +55years +6months')->translatedFormat('d M Y') }}
                                                        {{-- {{ date('Y-m-d', strtotime($b->tgl_lahir . ' +55years +6months')) }} --}}
                                                    @else
                                                        <span class="badge bg-warning">Sorry
                                                            It's Already On
                                                            select
                                                            Which From Previous Form</span>
                                                    @endif
                                                </td>
                                                <td class="text-sm font-weight-bold mb-0">
                                                    {{ Carbon\Carbon::parse($b->tgl_lahir . ' +56years')->translatedFormat('d M Y') }}
                                                    {{-- {{ date('Y-m-d', strtotime($b->tgl_lahir . ' +56years')) }} --}}
                                                </td>
                                                <td class="#">
                                                    @if ($b->is_karyawan === 0)
                                                        <span class="badge bg-danger">Non Aktif</span>
                                                    @else
                                                        @if ($b->tanggal_terakhir_pensiun < date('Y-m-d'))
                                                            <span class="badge bg-danger">Non Aktif -
                                                                {{ Carbon\Carbon::parse($b->tgl_lahir . ' +56years')->translatedFormat('d M Y') }}
                                                                {{-- {{ date('Y-m-d', strtotime($b->tgl_lahir . ' +56years')) }} --}}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-success">Masa Aktif -
                                                                {{ Carbon\Carbon::parse($b->tgl_lahir . ' +56years')->translatedFormat('d M Y') }}
                                                                {{-- {{ date('Y-m-d', strtotime($b->tgl_lahir . ' +56years')) }} --}}
                                                            </span>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- End Table with hoverable rows -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script_js')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
            $('body').on('click', '.delete', function() {
                var book_id = $(this).attr('book-id');
                var book_name = $(this).attr('book_name');

                swal({
                        title: "Are you sure?",
                        text: "The " + book_name + " wants to delete??",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        console.log(willDelete);
                        if (willDelete) {
                            //swal("Data siswa dengan id "+ siswa_id +" telah berhasil dihapus!", {
                            //icon: "success",
                            //});
                            window.location = "/book" + "/delete/" + book_id;

                        } else {
                            swal("Data is not deleted");
                        }
                    });
            });
        });

        @if (session()->has('sukses'))
            Toast.fire({
                icon: 'success',
                title: '{{ session()->pull('sukses') }}'
            })
        @elseif (session()->has('danger'))
            Toast.fire({
                icon: 'error',
                title: '{{ session()->pull('danger') }}'
            })
        @endif
    </script>
@endsection
