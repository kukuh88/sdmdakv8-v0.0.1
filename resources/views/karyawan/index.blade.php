@extends('layouts.master')

@section('page-title', 'ALL KARYAWAN')

@section('breadcrumbs')
    <li class="breadcrumb-item">Master Data</li>
    <li class="breadcrumb-item active">Karyawan</li>
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
                                <h5 class="card-title">Karyawan</h5>
                                @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif

                                @if (session()->has('failures'))
                                    <table class="table table-warning">
                                        <tr>
                                            <th>BARIS</th>
                                            <th>NIK</th>
                                            <th>Error</th>
                                        </tr>
                                        @foreach (session()->get('failures') as $validasi)
                                            <td>{{ $validasi->row() }}</td>
                                            <td>{{ $validasi->attribute() }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($validasi->errors as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ $validasi->values()[$validasi->attribute()] }}</td>
                                        @endforeach
                                    </table>
                                @endif
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
                                                    href="https://docs.google.com/spreadsheets/d/1utAJYUDw7KauE8sHZnfr2bXOYQkC-IzI/edit?usp=sharing&ouid=105678469809514382019&rtpof=true&sd=true">
                                                    <i class="bi bi-download"></i> Tamplate Data.xlsx
                                                </a></li>
                                            <li> <a type="button" class="btn btn-outline-warning" style="margin-top: 12px;"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <i class="bi bi-upload"></i> Import Data.xlsx
                                                </a></li>
                                            <li><a type="button" class="btn btn-outline-success" style="margin-top: 12px;"
                                                    href="{{ route('karyawanexport') }}"><i
                                                        class="bi bi-file-earmark-arrow-down"></i> Export Data.xlsx
                                                </a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                        </ul>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary" style="margin-top: 12px;"
                                        data-bs-toggle="modal" data-bs-target="#basicModal">
                                        Add Employee
                                    </button>
                                </div>
                                <!-- Basic Modal -->
                            </div>
                        </div>
                        <!-- Table with hoverable rows -->
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
                                            TANGGAL LAHIR</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            CALON KARYAWAN </th>
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
                                    @foreach ($karyawan as $b)
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
                                                <p class="text-xs font-weight-bold mb-0">{{ $b->name }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">{{ $b->jabatan }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{-- {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y', strtotime($b->tgl_lahir)) }} --}}
                                                    {{ Carbon\Carbon::parse($b->tgl_lahir)->translatedFormat('d F Y') }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{-- bagian menyesuaikan waktu --}}
                                                    {{-- {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y', strtotime($b->cakar)) }} --}}

                                                    {{-- bagian untuk translate waktu ke indonesia --}}
                                                    {{ Carbon\Carbon::parse($b->cakar)->translatedFormat('d F Y') }}
                                                </p>
                                            </td>
                                            <td class="#">
                                                @if ($b->tanggal_terakhir_pensiun < date('Y-m-d'))
                                                    <span class="badge bg-danger">Non Aktif
                                                    </span>
                                                @else
                                                    <span class="badge bg-success">Aktif
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('karyawan.edit', $b) }}"
                                                    class="btn btn-outline-warning bi bi-pencil-square"></a>

                                                <a href="#"
                                                    class="btn btn-outline-danger btn-action delete bi bi-trash"
                                                    data-url="{{ route('karyawan.destroy', $b) }}"
                                                    data-text="{{ $b->name }}"></a>
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
    {{-- model input exlce --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('karyawanimport') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="file" name="file" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Back</button>
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
                    <h5 class="modal-title">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <!-- General Form Elements -->
                        <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data"
                            class="row">
                            @csrf

                            {{-- NIK --}}
                            <div class="col-sm-6 mb-3{{ $errors->has('nik') ? ' has-error' : '' }}">
                                <label for="inputText" class="col-form-label">NIK</label>
                                <div>
                                    <input name="nik" type="number" id="nik" class="form-control"
                                        placeholder="Masukan Nik Anda" value="{{ old('nik') }}" required>
                                    @if ($errors->has('nik'))
                                        <span class="help-block" style="color: red;">{{ $errors->first('nik') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- NAMA LENGKAP --}}
                            <div class="col-sm-6 mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="inputText" class="col-form-label">Nama</label>
                                <div>
                                    <input name="name" type="text" id="name" class="form-control"
                                        placeholder="Masukan name Lengkap" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block" style="color: red;">{{ $errors->first('name') }}</span>
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

                            {{-- Tanggal Lahir Karyawan --}}
                            <div class="col-sm-6 mb-3 {{ $errors->has('tgl_lahir') ? ' has-error' : '' }}">
                                <label for="tgl_lahir" class="col-form-label">Tanggal Lahir Karyawan</label>
                                <div>
                                    <input name="tgl_lahir" type="date" id="tgl_lahir" class="form-control"
                                        placeholder="Masukan Tanggal Lahir" value="{{ old('tgl_lahir') }}" required>
                                    @if ($errors->has('tgl_lahir'))
                                        <span class="help-block"
                                            style="color: red;">{{ $errors->first('tgl_lahir') }}</span>
                                    @endif
                                </div>
                            </div>


                            {{-- CALON KARYAWAN --}}
                            <div class="col-sm-6 mb-3 {{ $errors->has('cakar') ? ' has-error' : '' }}">
                                <label for="cakar" class="col-form-label">CALON KARYAWAN</label>
                                <div>
                                    <input name="cakar" type="date" id="cakar" class="form-control"
                                        placeholder="Masukan Tanggal Cakar" value="{{ old('cakar') }}" required>
                                    @if ($errors->has('cakar'))
                                        <span class="help-block" style="color: red;">{{ $errors->first('cakar') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Foto --}}
                            <div class="col-sm-6 mb-3 {{ $errors->has('formFileSm') ? ' has-error' : '' }}">
                                <label for="formFileSm" class="col-form-label">Upload Foto</label>
                                <div>
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

                            {{-- GOLONGAN INI --}}
                            <div class="col-sm-6 mb-3 {{ $errors->has('golonganini') ? ' has-error' : '' }}">
                                <label for="golonganini" class="col-form-label">Golongan Saat Ini</label>
                                <div>
                                    <input name="golonganini" type="text" id="golonganini" class="form-control"
                                        placeholder="Masukan golongan yang sekarang Anda"
                                        value="{{ old('golonganini') }}" required>
                                    @if ($errors->has('golonganini'))
                                        <span class="help-block"
                                            style="color: red;">{{ $errors->first('golonganini') }}</span>
                                    @endif
                                </div>
                            </div>


                            {{-- TMT GOLONGAN INI --}}
                            <div class="col-sm-6 mb-3 {{ $errors->has('tmt_golonganini') ? ' has-error' : '' }}">
                                <label for="tmt_golonganini" class="col-form-label">TMT Golongan Ini</label>
                                <div>
                                    <input name="tmt_golonganini" type="date" id="tmt_golonganini"
                                        class="form-control" placeholder="Masukan golongan yang sekarang Anda"
                                        value="{{ old('tmt_golonganini') }}" required>
                                    @if ($errors->has('tmt_golonganini'))
                                        <span class="help-block"
                                            style="color: red;">{{ $errors->first('tmt_golonganini') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- ESELON SAAT INI --}}
                            <div class="col-sm-6 mb-3 {{ $errors->has('eselon') ? ' has-error' : '' }}">
                                <label for="eselon" class="col-form-label">Eselon Saat Ini</label>
                                <div>
                                    <select name="eselon" class="form-select" id="eselon"
                                        aria-label="Floating label select example" required>
                                        @foreach ($eselon as $s)
                                            <option value="{{ $s->eselon }}">{{ $s->eselon }}</option>
                                        @endforeach
                                        </option>
                                    </select>
                                </div>
                            </div>

                            {{-- TMT ESELON --}}
                            <div class="col-sm-6 mb-3 {{ $errors->has('tmt_eselon') ? ' has-error' : '' }}">
                                <label for="tmt_eselon" class="col-form-label">TMT Eselon</label>
                                <div>
                                    <input name="tmt_eselon" type="date" id="tmt_eselon" class="form-control"
                                        value="{{ old('tmt_eselon') }}" required>
                                    @if ($errors->has('tmt_eselon'))
                                        <span class="help-block"
                                            style="color: red;">{{ $errors->first('tmt_eselon') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <button type="submit" class="btn btn-outline-primary">Save</button>
                                <a href="/dashboard" type="button" class="btn btn-outline-primary"
                                    style="margin-top: 12px;">
                                    Home
                                </a>
                                <a href="/book" type="button" class="btn btn-outline-primary"
                                    style="margin-top: 12px;">
                                    Back
                                </a>
                            </div>
                    </div>
                    </form><!-- End General Form Elements -->

                </div>
            </div>
        </div>
    </div>
@endsection
@section('sweetalert')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
            $('body').on('click', '.delete', function() {
                var karyawan_id = $(this).attr('karyawan_id');
                var karyawan_nama = $(this).attr('karyawan_nama');

                swal({
                        title: "Are you sure?",
                        text: "The " + karyawan_nama + " wants to delete??",
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
                            window.location = "/karyawan" + "/delete/" + karyawan_id;

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
