@extends('layouts.master')

@section('page-title', 'ALL PKWT Dan Tenaga Ahli')

@section('breadcrumbs')
    <li class="breadcrumb-item">Data Master</li>
    <li class="breadcrumb-item active">PKWT Dan Tenaga Ahli</li>
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
                            <h5 class="card-title">PKWT Dan Tenaga Ahli</h5>
                        </div>
                        <div class="col-6">

                            <div class="right float-end">
                                <a type="button" class="btn btn-outline-primary" style="margin-top: 12px;"
                                    href="/dashboard">
                                    Back
                                </a>
                                <!-- Example single danger button -->
                                <div class="btn-group">
                                    <a type="button" class="btn btn-outline-primary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="margin-top: 12px;">
                                        Excel
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li> <a type="button" class="btn btn-outline-info" style="margin-top: 12px;"
                                                href="https://docs.google.com/spreadsheets/d/1uqbjbQLRvmaCRYW2LgGU2PHf11s_K71x/edit?usp=sharing&ouid=105678469809514382019&rtpof=true&sd=true">
                                                <i class="bi bi-download"></i> Tamplate Data.xlsx
                                            </a></li>
                                        <li> <a type="button" class="btn btn-outline-warning" style="margin-top: 12px;"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <i class="bi bi-upload"></i> Import Data.xlsx
                                            </a></li>
                                        <li><a type="button" class="btn btn-outline-success" style="margin-top: 12px;"
                                                href="{{ route('pkwtexport') }}"><i
                                                    class="bi bi-file-earmark-arrow-down"></i> Export Data.xlsx
                                            </a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-outline-primary" style="margin-top: 12px;"
                                    data-bs-toggle="modal" data-bs-target="#basicModal">
                                    Add PKWT
                                </button>
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
                                                KATEGORI KONTRAK</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                TANGGAL BERGABUNG</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                TANGGAL BERAKHIR</th>
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
                                        @foreach ($pkwt as $b)
                                            <tr>
                                                <td class="ps-3">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $no++ }}
                                                    </p>
                                                </td>
                                                <td class="ps-2">
                                                    <img src="{{ asset('storage/' . $b->formFileSm) }}"
                                                        style="max-width: 80px ; max-height:80px">
                                                </td>
                                                <td class="#">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $b->nik }}
                                                    </p>
                                                </td>
                                                <td class="#">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $b->full_name }}
                                                    </p>
                                                </td>
                                                <td class="#">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $b->jabatan }}
                                                    </p>
                                                </td>
                                                <td class="#">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $b->kategorikontrak->kategorikontrak ?? 'Bagian Kontrak Tidak Ditemukan' }}
                                                    </p>
                                                </td>
                                                <td class="#">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ Carbon\Carbon::parse($b->tgl_bergabung)->translatedFormat('d F Y') }}
                                                    </p>
                                                </td>
                                                <td class="#">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ Carbon\Carbon::parse($b->tgl_berakhir)->translatedFormat('d F Y') }}
                                                    </p>
                                                </td>
                                                <td class="#">
                                                    @if ($b->tgl_berakhir < date('Y-m-d'))
                                                        <span class="badge bg-danger">Non Aktif
                                                        </span>
                                                    @else
                                                        <span class="badge bg-success">Aktif
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('pkwt.edit', $b) }}"
                                                        class="btn btn-outline-warning bi bi-pencil-square"></a>

                                                    <a href="#"
                                                        class="btn btn-outline-danger btn-action delete bi bi-trash"
                                                        data-url="{{ route('pkwt.destroy', $b) }}"
                                                        data-text="{{ $b->full_name }}"></a>
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
            {{-- model input exlce --}}
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('pkwtimport') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="file" name="file" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Back</button>
                                <button type="submit" class="btn btn-outline-primary">Import Now</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            {{-- end import excel --}}

            <!-- Modal -->
            <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add PKWT</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">

                                <!-- General Form Elements -->
                                <form action="{{ route('pkwt.store') }}" method="POST" enctype="multipart/form-data"
                                    class="col-sm-12 row">
                                    @csrf

                                    {{-- NIK --}}
                                    <div class="col-sm-6 mb-3{{ $errors->has('nik') ? ' has-error' : '' }}">
                                        <label for="inputText" class="col-form-label">NIK</label>
                                        <div>
                                            <input name="nik" type="number" id="nik" class="form-control"
                                                placeholder="Masukan Nik Anda" value="{{ old('nik') }}" required>
                                            @if ($errors->has('nik'))
                                                <span class="help-block"
                                                    style="color: red;">{{ $errors->first('nik') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- NAMA LENGKAP --}}
                                    <div class="col-sm-6 mb-3 {{ $errors->has('full_name') ? ' has-error' : '' }}">
                                        <label for="inputText" class="col-form-label">Nama</label>
                                        <div>
                                            <input name="full_name" type="text" id="full_name" class="form-control"
                                                placeholder="Masukan full_name Lengkap" value="{{ old('full_name') }}"
                                                required>
                                            @if ($errors->has('full_name'))
                                                <span class="help-block"
                                                    style="color: red;">{{ $errors->first('full_name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- JABATAN --}}
                                    <div class="col-sm-6 mb-3 {{ $errors->has('jabatan') ? ' has-error' : '' }}">
                                        <label for="jabatan" class="col-form-label">Jabatan</label>
                                        <div>
                                            <input name="jabatan" type="text" id="jabatan" class="form-control"
                                                placeholder="Masukan Jabatan Anda" value="{{ old('jabatan') }}" required>
                                            @if ($errors->has('jabatan'))
                                                <span class="help-block"
                                                    style="color: red;">{{ $errors->first('jabatan') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Tanggal Bergabung --}}
                                    <div class="col-sm-6 mb-3 {{ $errors->has('tgl_bergabung') ? ' has-error' : '' }}">
                                        <label for="tgl_bergabung" class="col-form-label">Tanggal Bergabung
                                            Karyawan</label>
                                        <div>
                                            <input name="tgl_bergabung" type="date" id="tgl_bergabung"
                                                class="form-control" placeholder="Masukan Tanggal Lahir"
                                                value="{{ old('tgl_bergabung') }}" required>
                                            @if ($errors->has('tgl_bergabung'))
                                                <span class="help-block"
                                                    style="color: red;">{{ $errors->first('tgl_bergabung') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Kategori Kontrak --}}
                                    <div class="col-sm-6 mb-3 {{ $errors->has('kategorikontrak') ? ' has-error' : '' }}">
                                        <label for="tgl_berakhir" class="col-form-label">Kategori Kontrak</label>
                                        <div>

                                            {{-- @dd($kategorikontrak) --}}
                                            <select name="id_kategorikontrak" type="text" id="kategorikontrak"
                                                class="form-control" placeholder="Masukan Kategori Kontrak"
                                                value="{{ old('kategorikontrak') }}" required>
                                                <option value="">-- Select Kategori Kontrak --</option>
                                                @foreach ($kategorikontrak as $kk)
                                                    {{-- @dd($kk->id) --}}
                                                    <option value="{{ $kk->id }}">{{ $kk->kategorikontrak }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('kategorikontrak'))
                                                <span class="help-block"
                                                    style="color: red;">{{ $errors->first('kategorikontrak') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Tanggal Berakhir --}}
                                    <div class="col-sm-6 mb-3 {{ $errors->has('tgl_berakhir') ? ' has-error' : '' }}">
                                        <label for="tgl_berakhir" class="col-form-label">Tanggal Berakhir Karyawan</label>
                                        <div>
                                            <input name="tgl_berakhir" type="date" id="tgl_berakhir"
                                                class="form-control" placeholder="Masukan Tanggal tgl_berakhir"
                                                value="{{ old('tgl_berakhir') }}" required>
                                            @if ($errors->has('tgl_berakhir'))
                                                <span class="help-block"
                                                    style="color: red;">{{ $errors->first('tgl_berakhir') }}</span>
                                            @endif
                                        </div>
                                    </div>


                                    {{-- Foto --}}
                                    <div class="col-sm-12 mb-3 {{ $errors->has('formFileSm') ? ' has-error' : '' }}">
                                        <div>
                                            <label for="formFileSm" class="col-form-label">Upload Foto</label>
                                            <img class="img-priview img-fluid">
                                            <input name="formFileSm" type="file" id="formFileSm" class="form-control"
                                                placeholder="Upload Foto Karyawan" value="{{ old('formFileSm') }}"
                                                onchange="priviewImage()" required>
                                            @if ($errors->has('formFileSm'))
                                                <span class="help-block"
                                                    style="color: red;">{{ $errors->first('formFileSm') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn btn-outline-success">Save</button>
                                        <a href="{{ route('pkwt.index') }}" class="btn btn-outline-danger">Close</a>
                                    </div>
                            </div>
                            </form><!-- End General Form Elements -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script_js')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
            $('body').on('click', '.delete', function() {
                var pkwt_id = $(this).attr('pkwt_id');
                var pkwt_full_name = $(this).attr('pkwt_full_name');

                swal({
                        title: "Are you sure?",
                        text: "The " + pkwt_full_name + " wants to delete??",
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
                            window.location = "/pkwt" + "/delete/" + pkwt_id;

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
