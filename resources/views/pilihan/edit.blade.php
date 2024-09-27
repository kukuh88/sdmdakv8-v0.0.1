@extends('layouts.master')
@section('content')
    @if (session('sukses'))
        <div class="alert alert-success" role="alert">
            {{ session('sukses') }}
        </div>
    @endif
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>EDIT EMPLOYEE GOPIL</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/pilihan">GoPil</a></li>
                    <li class="breadcrumb-item active">Edit GoPil</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">EDIT GoPil</h5>
                                    @if (Session::has('sukses'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('sukses') }}
                                    @endif
                                </div>
                                <div class="col-6">
                                    <div class="right float-end">
                                        <a href="/book" type="button" class="btn btn-outline-primary"
                                            style="margin-top: 12px;">
                                            Back
                                        </a>
                                    </div>
                                    <!-- Basic Modal -->
                                </div>
                            </div>


                            <form action="{{ route('pilihan.update', $pilihan) }}" method="POST">
                                {{ csrf_field() }}
                                @method('PUT')
                                <!-- NIK -->
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">NIK</label>
                                    <div class="col-sm-10">
                                        <input name="nik" type="text" class="form-control" id="nik"
                                            aria-describedby="emailHelp" placeholder="Nama book"
                                            value="{{ $pilihan->nik }}">
                                    </div>
                                </div>

                                <!-- FULL NAME -->
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" type="text" class="form-control" id="name"
                                            placeholder="FUll Name" value="{{ $pilihan->name }}">
                                    </div>
                                </div>

                                <!-- Jabatan -->
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <input name="jabatan" type="text" id="jabatan" class="form-control"
                                            id="jabatan" placeholder="jabatan" value="{{ $pilihan->jabatan }}">
                                    </div>
                                </div>

                                <!-- GOLONGAN INI -->
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">Golongan Saat Ini</label>
                                    <div class="col-sm-10">
                                        <input name="golonganini" type="text" id="golonganini" class="form-control"
                                            id="golonganini" placeholder="golonganini" value="{{ $pilihan->golonganini }}">
                                    </div>
                                </div>

                                <!-- TMT GOLONGAN INI -->
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">TMT Golongan Saat Ini</label>
                                    <div class="col-sm-10">
                                        <input name="tmt_golonganini" type="text" id="tmt_golonganini"
                                            class="form-control" id="tmt_golonganini" placeholder="tmt_golonganini"
                                            value="{{ $pilihan->tmt_golonganini }}">
                                    </div>
                                </div>

                                <!-- GOLONGAN Mendatang -->
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">Golongan Mendatang</label>
                                    <div class="col-sm-10">
                                        <input name="golongan" type="text" id="golongan" class="form-control"
                                            id="golongan" placeholder="golongan" value="{{ $pilihan->golongan }}">
                                    </div>
                                </div>

                                <!-- TMT GOLONGAN Mendatang -->
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">TMT Golongan Mendatang</label>
                                    <div class="col-sm-10">
                                        <input name="tmt_golongan" type="date" id="tmt_golongan" class="form-control"
                                            id="tmt_golongan" placeholder="tmt_golongan"
                                            value="{{ $pilihan->tmt_golongan }}">
                                    </div>
                                </div>

                                <!-- ESELON -->
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">TMT Golongan Mendatang</label>
                                    <div class="col-sm-10">
                                        <input name="eselon" type="text" id="eselon" class="form-control"
                                            id="eselon" placeholder="eselon" value="{{ $pilihan->eselon }}">
                                    </div>
                                </div>

                                <!-- TMT ESELON -->
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">TMT Golongan Mendatang</label>
                                    <div class="col-sm-10">
                                        <input name="tmt_eselon" type="date" id="tmt_eselon" class="form-control"
                                            id="tmt_eselon" placeholder="tmt_eselon" value="{{ $pilihan->tmt_eselon }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Submit Button</label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-outline-primary">Save Update</button>
                                    </div>
                                </div>

                            </form><!-- End General Form Elements -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
