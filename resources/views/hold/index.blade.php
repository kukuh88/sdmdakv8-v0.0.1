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
                                <h5 class="card-title">All Hold On</h5>
                            </div>
                            <div class="col-6">

                                <div class="right float-end">
                                    <a type="button" class="btn btn-outline-primary" style="margin-top: 12px;"
                                        href="/dashboard">
                                        Back
                                    </a>

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive p-0">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NO
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            FOTO
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
                                            GOLONGAN SAAT INI</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            TMT GOLONGAN SAAT INI</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            GOLONGAN MENDATANG</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            TMT GOLONGAN MENDATANG</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            ESELON</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            TMT ESELON</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            STATUS KENAIKAN</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            KETERANGAN</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            STATUS</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            ACTION</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    @foreach ($book as $b)
                                        <tr>
                                            <td class="ps-3">
                                                <p class="text-xs font-weight-bold mb-0">{{ $no++ }}
                                                </p>
                                            </td>
                                            <td class="ps-2">
                                                <img src="{{ asset('storage/' . $b->karyawan->formFileSm) }}"
                                                    style="max-width: 80px ; max-height:80px">
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">{{ $b->karyawan->nik }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $b->karyawan->name }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $b->karyawan->jabatan }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{-- {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y', strtotime($b->tgl_lahir)) }} --}}

                                                    {{ $b->golonganini }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{-- bagian menyesuaikan waktu --}}
                                                    {{-- {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y', strtotime($b->cakar)) }} --}}

                                                    {{-- bagian untuk translate waktu ke indonesia --}}
                                                    {{ Carbon\Carbon::parse($b->tmt_golonganini)->translatedFormat('d M Y') }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">{{ $b->golongan }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ Carbon\Carbon::parse($b->tmt_golongan)->translatedFormat('d M Y') }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">{{ $b->eselon }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ Carbon\Carbon::parse($b->tmt_eselon)->translatedFormat('d M Y') }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    @if ($b->is_pilihan)
                                                        <a class="badge rounded-pill bg-success" href="/pilihan">Pilihan</a>
                                                    @else
                                                        <a class="badge rounded-pill bg-info" href="/book">Reguler</a>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{-- {{ $b->lastKenaikanTingkat['keterangan'] }} --}}
                                                    {{-- {{ $b->lastKenaikanTingkat->keterangan }} --}}
                                                    {{ $b->lastKenaikanTingkat ? $b->lastKenaikanTingkat->keterangan : '' }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                @if ($b->is_karyawan === 1)
                                                    <label class="badge rounded-pill bg-success">Disable
                                                        Hold</label>
                                                @else
                                                    <label class="badge rounded-pill bg-warning"> Hold</label>
                                                @endif
                                            </td>
                                            <td>
                                                <a data-url="{{ route('karyawan.approval-tingkat', $b->id_karyawan) }}"
                                                    data-emp_name="{{ $b->name }}" data-level="{{ $b->golonganini }}"
                                                    data-level_up="{{ $b->golongan }}"
                                                    class="btn btn-sm btn-outline-success btn-approve-acc">ACC</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script_js')
    <script>
        var table;
        var pageJs = {
            acc: function() {
                jQuery(document).on("click", ".btn-approve-acc", function() {
                    let endpoint = jQuery(this).data("url");
                    console.log(endpoint);
                    let empName = jQuery(this).data("emp_name");
                    let level = jQuery(this).data("level");
                    let levelUp = jQuery(this).data("level_up");
                    let promptMessage =
                        "Anda akan approve karyawan \ <strong>" +
                        empName +
                        "</strong> \ naik ke tingkat " +
                        levelUp +
                        ", \ lanjutkan?"
                    Swal.fire({
                        title: "Are you sure?",
                        html: promptMessage,
                        icon: "warning",
                        showLoaderOnConfirm: true,
                        showCancelButton: true,
                        showCloseButton: true,
                        reverseButtons: true,
                        backdrop: true,
                        confirmButtonText: "Yes",
                        customClass: {
                            confirmButton: "btn btn-danger",
                            cancelButton: "btn btn-primary"
                        },
                        preConfirm: () => {
                            return new Promise(function(resolve) {
                                jQuery.ajax({
                                        type: "POST",
                                        url: endpoint,
                                        data: {
                                            _token: CrmApp.getCsrfToken(),
                                            golonganini: level,
                                            golongannaik: levelUp,
                                            status: 1
                                        },
                                        dataType: "JSON",
                                    })
                                    .done(function(response) {
                                        Swal.fire(
                                            response.title,
                                            response.message,
                                            response.status
                                        );
                                        // table.ajax.reload();
                                        location.href = "{{ url('/employee') }}"
                                    })
                                    .fail(function() {
                                        Swal.fire("Oops...",
                                            "Something went wrong. Please Try Again.",
                                            "error");
                                    });
                            });
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        //
                    });
                });
                table = jQuery('#datatable').DataTable({

                });

                jQuery(document).on("click", "#btn-filter", function() {
                    let fromDate = jQuery("#from_date").val();
                    let toDate = jQuery("#to_date").val();

                    if (fromDate && toDate) {
                        table.ajax.reload();
                    } else {
                        swal.fire({
                            icon: "error",
                            text: "Both date are required",
                        });
                    }
                });

                jQuery(document).on("click", "#btn-refresh", function() {
                    table.ajax.reload();
                });
            },
        };
        pageJs.acc();

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
