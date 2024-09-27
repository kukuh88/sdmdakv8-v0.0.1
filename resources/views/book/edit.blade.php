@extends('layouts.master')

@section('page-title', 'EDIT GolReg/GolPil')

@section('breadcrumbs')
    <li class="breadcrumb-item">Master Data</li>
    <li class="breadcrumb-item">GolReg/GolPil</li>
    <li class="breadcrumb-item active">Edit Golongan</li>
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
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">EDIT Employee</h5>

                        </div>
                        <div class="col-6">
                            <div class="right float-end">
                                <a href="/book" type="button" class="btn btn-outline-primary" style="margin-top: 12px;">
                                    Back
                                </a>
                            </div>
                            <!-- Basic Modal -->
                        </div>
                    </div>


                    <form action="{{ route('book.update', $book) }}" method="POST">
                        {{ csrf_field() }}
                        @method('PUT')


                        <!-- NIK -->
                        <div class="row mb-3">
                            <label for="text" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-6">
                                <input name="nik" type="text" class="form-control" id="nik"
                                    aria-describedby="emailHelp" placeholder="Nama book" value="{{ $book->karyawan->nik }}"
                                    disabled>
                            </div>
                        </div>

                        <!-- FULL NAME -->
                        <div class="row mb-3">
                            <label for="text" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-6">
                                <input name="name" type="text" class="form-control" id="name"
                                    placeholder="FUll Name" value="{{ $book->karyawan->name }}" disabled>
                            </div>
                        </div>

                        <!-- Jabatan -->
                        <div class="row mb-3">
                            <label for="text" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-6">
                                <input name="jabatan" type="text" id="jabatan" class="form-control" id="jabatan"
                                    placeholder="jabatan" value="{{ $book->karyawan->jabatan }}" disabled>
                            </div>
                        </div>



                        <!-- GOLONGAN INI -->
                        <div class="row mb-3">
                            <label for="text" class="col-sm-2 col-form-label">Golongan Saat Ini</label>
                            <div class="col-sm-6">
                                <input name="golonganini" type="number" id="golonganini" class="form-control"
                                    id="golonganini" placeholder="golonganini" value="{{ $book->golonganini }}" disabled>
                            </div>
                        </div>

                        <!-- TMT GOLONGAN INI -->
                        <div class="row mb-3">
                            <label for="text" class="col-sm-2 col-form-label">TMT Golongan Saat Ini</label>
                            <div class="col-sm-6">
                                <input name="tmt_golonganini" type="date" id="tmt_golonganini" class="form-control"
                                    id="tmt_golonganini" placeholder="tmt_golonganini" value="{{ $book->tmt_golonganini }}"
                                    disabled>
                            </div>
                        </div>

                        <!-- ESELON -->
                        <div class="row mb-3">
                            <label for="text" class="col-sm-2 col-form-label">Eselon Saat Ini</label>
                            <div class="col-sm-6">
                                <select name="eselon" type="text" id="eselon" class="form-control" id="eselon">
                                    @foreach ($eselon as $e)
                                        <option value="{{ $e->eselon }}">{{ $e->eselon }}</option>
                                    @endforeach
                                    </option>
                                </select>

                            </div>
                        </div>

                        <!-- TMT ESELON -->
                        <div class="row mb-3">
                            <label for="text" class="col-sm-2 col-form-label">TMT Eselon</label>
                            <div class="col-sm-6">
                                <input name="tmt_eselon" type="date" id="tmt_eselon" class="form-control" id="tmt_eselon"
                                    placeholder="tmt_eselon" value="{{ $book->tmt_eselon }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Submit Button</label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-outline-primary">Save Update</button>
                            </div>
                        </div>

                    </form><!-- End General Form Elements -->
                </div>
            </div>
        </div>
    </div>
@endsection
