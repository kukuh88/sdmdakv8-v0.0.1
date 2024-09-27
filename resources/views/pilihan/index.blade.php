@extends('layouts.master')

@section('page-title', 'ALL GOLONGAN PILIHAN')

@section('breadcrumbs')
    <li class="breadcrumb-item">Master Data</li>
    <li class="breadcrumb-item active">GolPil</li>
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
                            <h5 class="card-title">GolPil </h5>
                            @if (Session::has('sukses'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('sukses') }}
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="right float-end">
                                <a type="button" class="btn btn-outline-primary" style="margin-top: 12px;"
                                    href="/employee">
                                    Back
                                </a>
                                {{-- <button type="button" class="btn btn-primary" style="margin-top: 12px;"
                                            data-bs-toggle="modal" data-bs-target="#basicModal">
                                            Add GoPil
                                        </button> --}}
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
                                                TMT GOLONGAN SAAT INI </th>
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
                                        @foreach ($pilihan as $p)
                                            <tr>
                                                <td class="ps-4">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $no++ }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $p->karyawan->nik }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $p->karyawan->name }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $p->karyawan->jabatan }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $p->golonganini }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ Carbon\Carbon::parse($p->tmt_golonganini)->translatedFormat('d M Y') }}
                                                        {{-- {{ $p->tmt_golonganini }} --}}
                                                    </p>
                                                </td>

                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $p->golongan }}</p>
                                                </td>

                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ Carbon\Carbon::parse($p->tmt_golongan)->translatedFormat('d M Y') }}
                                                        {{-- {{ $p->tmt_golongan }} --}}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $p->eselon }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ Carbon\Carbon::parse($p->tmt_eselon)->translatedFormat('d M Y') }}
                                                        {{-- {{ $p->tmt_eselon }} --}}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <label
                                                        class="btn {{ $p->status == 1 ? 'badge rounded-pill bg-success' : 'badge rounded-pill bg-danger' }}">{{ $p->status == 1 ? 'Pilihan' : 'GolPil' }}</label>
                                                </td>
                                                <td>
                                                    <a href="{{ route('book.edit', $p) }}"
                                                        class="btn btn-outline-warning bi bi-pencil-square"></a>
                                                    <a href="#"
                                                        class="btn btn-outline-danger btn-action delete bi bi-trash"
                                                        data-url="{{ route('book.destroy', $p) }}"
                                                        data-text="{{ $p->karyawan->name }}"></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add GoPil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <!-- General Form Elements -->
                        <form action="{{ route('pilihan.store') }}" method="POST">
                            @csrf

                            {{-- NIK --}}
                            <div class="row mb-3{{ $errors->has('nik') ? ' has-error' : '' }}">
                                <label for="inputText" class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input name="nik" type="text" id="nik" class="form-control"
                                        placeholder="Masukan Nik Anda" value="{{ old('nik') }}">
                                    @if ($errors->has('nik'))
                                        <span class="help-block" style="color: red;">{{ $errors->first('nik') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- NAMA LENGKAP --}}
                            <div class="row mb-3{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" id="name" class="form-control"
                                        placeholder="Masukan Nama Lengkap" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block" style="color: red;">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- JABATAN --}}
                            <div class="row mb-3{{ $errors->has('jabatan') ? ' has-error' : '' }}">
                                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input name="jabatan" type="text" id="jabatan" class="form-control"
                                        placeholder="Masukan Jabatan Anda" value="{{ old('jabatan') }}">
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
                                <label for="tmt_golonganini" class="col-sm-2 col-form-label">TMT Golongan
                                    Ini</label>
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
                            window.location = "/pilihan" + "/delete/" + book_id;

                        } else {
                            swal("Data is not deleted");
                        }
                    });
            });
        });
    </script>
@endsection
