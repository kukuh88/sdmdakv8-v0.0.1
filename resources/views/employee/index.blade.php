@extends('layouts.master')

@section('page-title', 'ALL EMPLOYEE')

@section('breadcrumbs')
    <li class="breadcrumb-item">Master Data</li>
    <li class="breadcrumb-item active">Employee</li>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">All Employees</h5>
                        </div>
                        <div class="col-6">
                            <div class="right float-end">
                                <a type="button" class="btn btn-outline-primary" style="margin-top: 12px;"
                                    href="/karyawan">
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <form class="row g-3 mb-3">
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="date" id="from_date" class="form-control">
                                    <span class="input-group-text">to</span>
                                    <input type="date" id="to_date" class="form-control">
                                    <span class="input-group-text"></span>
                                    <input class="form-control" type="search" placeholder="Search" id="search">
                                    {{-- <input class="form-control " type="number" placeholder="NIK" id="nik"> --}}
                                </div>
                            </div>
                            <div class="col-sm d-flex align-items-center">
                                <button type="button" id="btn-filter" class="btn btn-info btn-sm">
                                    <i class="bi bi-search"></i> Filter
                                </button>
                                <button type="reset" id="btn-refresh" class="btn btn-warning btn-sm ms-1">
                                    <i class="bi bi-arrow-clockwise"></i> Refresh
                                </button>
                            </div>
                        </form>

                    </div>
                    <div class="table-responsive p-0">
                        <table class="table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        NO
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NIK</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NAMA LENGKAP</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        JABATAN</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        GOLONGAN SAAT INI </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TMT GOLONGAN </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        GOLONGAN MENDATANG </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TMT GOLONGAN MENDATANG </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        ESLON</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TMT ESLON</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TMT PENSIUN</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        STATUS GOLONGAN</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        KETERANGAN</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        ACTION</th>
                                </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <!-- General Form Elements -->
                        <form action="{{ route('book.store') }}" method="POST">
                            @csrf

                            {{-- NIK --}}
                            <div class="row mb-3{{ $errors->has('id_karyawan') ? ' has-error' : '' }}">
                                <label for="inputText" class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <select name="id_karyawan" class="form-select" id="input-nik"
                                        aria-label="Floating label select example" onchange="queryEmployee()">
                                        <option value="">Pilih Karyawan</option>
                                        @foreach ($karyawan as $s)
                                            <option value="{{ $s->id }}">{{ $s->nik }}</option>
                                            @if ($errors->has('id_karyawan'))
                                                <span class="help-block"
                                                    style="color: red;">{{ $errors->first('nik') }}</span>
                                            @endif
                                        @endforeach
                                        </option>
                                    </select>
                                </div>
                            </div>

                            {{-- NAMA LENGKAP --}}
                            <div class="row mb-3{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input name="name" id="input-name" class="form-control"
                                        placeholder="Masukan Nama Lengkap" readonly>

                                    @if ($errors->has('name'))
                                        <span class="help-block" style="color: red;">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- JABATAN --}}
                            <div class="row mb-3{{ $errors->has('jabatan') ? ' has-error' : '' }}">
                                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input name="jabatan" type="text" id="input-jabatan" class="form-control"
                                        placeholder="Masukan Jabatan Anda" value="{{ old('jabatan') }}" readonly>
                                    @if ($errors->has('jabatan'))
                                        <span class="help-block"
                                            style="color: red;">{{ $errors->first('jabatan') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- GOLONGAN INI --}}
                            <div class="row mb-3{{ $errors->has('golonganini') ? ' has-error' : '' }}">
                                <label for="golonganini" class="col-sm-2 col-form-label">Golongan Saat Ini</label>
                                <div class="col-sm-10">
                                    <input name="golonganini" type="text" id="golonganini" class="form-control"
                                        placeholder="Masukan golongan yang sekarang Anda"
                                        value="{{ old('golonganini') }}">
                                    @if ($errors->has('golonganini'))
                                        <span class="help-block"
                                            style="color: red;">{{ $errors->first('golonganini') }}</span>
                                    @endif
                                </div>
                            </div>


                            {{-- TMT GOLONGAN INI --}}
                            <div class="row mb-3{{ $errors->has('tmt_golonganini') ? ' has-error' : '' }}">
                                <label for="tmt_golonganini" class="col-sm-2 col-form-label">TMT Golongan Ini</label>
                                <div class="col-sm-10">
                                    <input name="tmt_golonganini" type="date" id="tmt_golonganini"
                                        class="form-control" placeholder="Masukan golongan yang sekarang Anda"
                                        value="{{ old('tmt_golonganini') }}">
                                    @if ($errors->has('tmt_golonganini'))
                                        <span class="help-block"
                                            style="color: red;">{{ $errors->first('tmt_golonganini') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- ESELON SAAT INI --}}
                            <div class="row mb-3{{ $errors->has('eselon') ? ' has-error' : '' }}">
                                <label for="eselon" class="col-sm-2 col-form-label">Eselon Saat Ini</label>
                                <div class="col-sm-10">
                                    <select name="eselon" class="form-select" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        @foreach ($eselon as $s)
                                            <option value="{{ $s->eselon }}">{{ $s->eselon }}</option>
                                        @endforeach
                                        </option>
                                    </select>
                                </div>
                            </div>

                            {{-- TMT ESELON --}}
                            <div class="row mb-3{{ $errors->has('tmt_eselon') ? ' has-error' : '' }}">
                                <label for="tmt_eselon" class="col-sm-2 col-form-label">TMT Eselon</label>
                                <div class="col-sm-10">
                                    <input name="tmt_eselon" type="date" id="tmt_eselon" class="form-control"
                                        value="{{ old('tmt_eselon') }}">
                                    @if ($errors->has('tmt_eselon'))
                                        <span class="help-block"
                                            style="color: red;">{{ $errors->first('tmt_eselon') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="row mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="/dashboard" type="button" class="btn btn-primary" style="margin-top: 12px;">
                                    Home
                                </a>
                                <a href="/book" type="button" class="btn btn-primary" style="margin-top: 12px;">
                                    Back
                                </a>
                            </div>
                    </div>
                    </form><!-- End General Form Elements -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-hold-approval" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hold Approval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="url-hold-input">
                    <input type="hidden" id="level-hold-input">
                    <input type="hidden" id="levelup-hold-input">
                    <div class="row mb-3">
                        <label for="reason-hold-input" class="col-sm-2 col-form-label">Alasan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="reason-hold-input" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btn-submit-hold">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sweetalert')
    <script>
        var table;
        var pageJs = {
            init: function() {
                jQuery(document).on("click", ".btn-approve-tingkat", function() {
                    let endpoint = jQuery(this).data("url");
                    let empName = jQuery(this).data("emp_name");
                    let level = jQuery(this).data("level");
                    let levelUp = jQuery(this).data("level_up");
                    // error_log('Some message here.');
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
                                        location.reload();
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

                jQuery(document).on("click", ".btn-hold-tingkat", function() {
                    let url = jQuery(this).data("url");
                    let level = jQuery(this).data("level");
                    let levelUp = jQuery(this).data("level_up");

                    jQuery("#url-hold-input").val(url);
                    jQuery("#level-hold-input").val(level);
                    jQuery("#levelup-hold-input").val(levelUp);
                });

                jQuery(document).on("click", "#btn-submit-hold", function() {
                    jQuery(this).addClass("disabled");
                    let endpoint = jQuery("#url-hold-input").val();
                    let level = jQuery("#level-hold-input").val();
                    let levelUp = jQuery("#levelup-hold-input").val();
                    let reason = jQuery("#reason-hold-input").val();

                    jQuery.ajax({
                            type: "POST",
                            url: endpoint,
                            data: {
                                _token: CrmApp.getCsrfToken(),
                                golonganini: level,
                                golongannaik: levelUp,
                                keterangan: reason,
                                status: 0
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
                            // location.reload();
                            location.href = "{{ url('/hold') }}"
                        })
                        .fail(function() {
                            Swal.fire("Oops...",
                                "Something went wrong. Please Try Again.",
                                "error");
                        });
                });

                jQuery(document).on("hidden.bs.modal", "#modal-hold-approval", function() {
                    jQuery("#url-hold-input").val("");
                    jQuery("#level-hold-input").val("");
                    jQuery("#levelup-hold-input").val("");
                    jQuery("#reason-hold-input").val("");
                    jQuery("#btn-submit-hold").removeClass("disabled");
                });

                table = jQuery('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('employee.fetch_data') }}",
                        method: "POST",
                        data: function(data) {
                            data._token = jQuery('meta[name="csrf-token"]').attr("content");
                            data.from_date = jQuery("#from_date").val();
                            data.to_date = jQuery("#to_date").val();
                            data.search = jQuery("#search").val();
                            // data.nik = jQuery("#nik").val();
                        },
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            className: 'align-middle text-center',
                            searchable: false,
                            sortable: false
                        },
                        {
                            data: 'nik',
                            name: 'nik',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                        {
                            data: 'nama_karyawan',
                            name: 'nama_karyawan',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                        {
                            data: 'jabatan',
                            name: 'jabatan',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                        {
                            data: 'golonganini',
                            name: 'golonganini',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                        {
                            data: 'tgl_golonganini',
                            name: 'tgl_golonganini',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                        {
                            data: 'golongan',
                            name: 'golongan',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                        {
                            data: 'tgl_golongan',
                            name: 'tgl_golongan',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                        {
                            data: 'eselon',
                            name: 'eselon',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                        {
                            data: 'tgl_eselon',
                            name: 'tgl_eselon',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                        {
                            data: 'tmt_pensiun',
                            name: 'tmt_pensiun',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                        {
                            data: 'status_golongan',
                            name: 'status_golongan',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                        {
                            data: 'aksi',
                            className: 'align-middle text-center',
                            searchable: false,
                        },
                    ],
                });

                jQuery(document).on("click", "#btn-filter", function() {
                    table.ajax.reload();

                    // let fromDate = jQuery("#from_date").val();
                    // let toDate = jQuery("#to_date").val();
                    // let search = jQuery("#search").val();

                    // if (fromDate && toDate && search) {
                    //     table.ajax.reload();
                    // } else {
                    //     swal.fire({
                    //         icon: "error",
                    //         text: "Both date are required",
                    //     });
                    // }
                });

                jQuery(document).on("click", "#btn-refresh", function() {
                    table.ajax.reload();
                });
            },
        };

        pageJs.init();

        function queryEmployee() {
            const id_karyawan = jQuery("#input-nik").val()
            if (id_karyawan) {
                const url = `{{ url('/book/detail_karyawan') }}/${id_karyawan}`
                $.ajax({
                    url,
                    method: "GET",
                    success: (res) => {
                        //textarea
                        //select
                        //input

                        $("#input-name").val(res.name)
                        $("#input-jabatan").val(res.jabatan)
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            }

        }
        $(document).ready(function() {
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
        @elseif (session()->has('info'))
            Toast.fire({
                icon: 'info',
                title: '{{ session()->pull('info') }}'
            })
        @endif
    </script>
@endsection
