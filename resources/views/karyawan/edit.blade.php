@extends('layouts.master')

@section('page-title', 'ALL EMPLOYEE')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="/">Master Data</a></li>
    <li class="breadcrumb-item"><a href="/karyawan">Employee</a></li>
    <li class="breadcrumb-item active">Edit Employee </li>
@endsection

@section('style_css')
    <style>
        .table-responsive {
            font-size: .8em !important;
        }

        div.dataTables_processing {
            z-index: 1;
        }

        .img-priview {
            width: 100%;
            max-width: 300px;
        }
    </style>
@endsection

@section('content')
    @if (session('sukses'))
        <div class="alert alert-success" role="alert">
            {{ session('sukses') }}
        </div>
    @endif
    <section class="section">
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">EDIT Employee</h5>
                                @if (Session::has('sukses'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('sukses') }}
                                @endif
                            </div>
                            <div class="col-6">
                                <div class="right float-end">
                                    <a href="/karyawan" type="button" class="btn btn-outline-primary"
                                        style="margin-top: 12px;">
                                        Back
                                    </a>
                                </div>
                                <!-- Basic Modal -->
                            </div>
                        </div>

                        <form action="{{ route('karyawan.update', $karyawan) }}" method="POST"
                            enctype="multipart/form-data" class="row" id="form-update" onsubmit="submitAjax(event)">
                            {{ csrf_field() }}
                            @method('PUT')

                            <div class="col-md-8">


                                <!-- NIK -->
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">NIK</label>
                                    <div class="col-sm-9">
                                        <input name="nik" type="number" class="form-control" id="nik"
                                            aria-describedby="emailHelp" placeholder="NIK Karyawan"
                                            value="{{ $karyawan->nik }}">
                                    </div>
                                </div>

                                <!-- FULL NAME -->
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-9">
                                        <input name="name" type="text" class="form-control" id="name"
                                            placeholder="FUll nama" value="{{ $karyawan->name }}">
                                    </div>
                                </div>

                                <!-- Jabatan -->
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-9">
                                        <input name="jabatan" type="text" id="jabatan" class="form-control"
                                            id="jabatan" placeholder="jabatan" value="{{ $karyawan->jabatan }}">
                                    </div>
                                </div>

                                {{-- Tanggal Lahir Karyawan --}}
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">Tanggal lahir</label>
                                    <div class="col-sm-9">
                                        <input name="tgl_lahir" type="date" id="tgl_lahir" class="form-control"
                                            id="tgl_lahir" placeholder="tgl_lahir" value="{{ $karyawan->tgl_lahir }}">
                                    </div>
                                </div>

                                {{-- CALON KARYAWAN --}}
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-2 col-form-label">Tanggal Calon Karyawan</label>
                                    <div class="col-sm-9">
                                        <input name="cakar" type="date" id="cakar" class="form-control"
                                            id="cakar" placeholder="cakar" value="{{ $karyawan->cakar }}">
                                    </div>
                                </div>

                                <!-- foto -->
                                <div class="row mb-2">
                                    <label for="formFileSm" class="col-sm-2 col-form-label">Profil Karyawan</label>

                                    <div class="col-sm-9">
                                        <input name="formFileSm" type="file" class="form-control" id="formFileSm"
                                            value="{{ $karyawan->formFileSm }}" onchange="previewImage()">
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-4">
                                @if ($karyawan->formFileSm)
                                    <img src="{{ asset('storage/' . $karyawan->formFileSm) }}" class="img-priview"
                                        id="img-foto">
                                @else
                                    <img class="img-priview" id="img-foto">
                                @endif
                                <button type="button" class="btn btn-outline-danger" style="display: none"
                                    id="btn-reset" onclick="resetImage()"> Reset Foto </button>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Data Employee : </label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-outline-primary">Save Update</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('sweetalert')
    <script>
        const img_asli = "{{ asset('storage/' . $karyawan->formFileSm) }}";

        let input_file_value = null

        function submitAjax(e) {
            e.preventDefault()
            const form_asli = document.querySelector('#form-update')
            const form_data = new FormData(form_asli)

            if (input_file_value) {
                form_data.delete('formFileSm')
                form_data.append('formFileSm', input_file_value, input_file_value.name)
            }

            $.ajax({
                url: form_asli.action,
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function(res) {
                    Toast.fire({
                        icon: 'success',
                        title: res
                    })
                    location.href = "{{ url('/karyawan') }}"
                },
                error: function(err) {
                    Toast.fire({
                        icon: 'error',
                        title: err.responseText
                    })
                }
            });
        }

        function previewImage() {
            const inputfile = document.querySelector('#formFileSm')

            const file = inputfile.files[0]
            if (file) {
                const src = URL.createObjectURL(file)
                document.querySelector('#img-foto').src = src
                $("#btn-reset").show()
                input_file_value = file
            }
        }

        function resetImage() {
            document.querySelector('#img-foto').src = img_asli
            document.querySelector('#formFileSm').value = ''
            $("#btn-reset").hide()
            input_file_value = null
        }

        @if (session()->has('sukses'))
            Toast.fire({
                icon: "success",
                title: "{{ session()->pull('sukses') }}"
            });
        @elseif (session()->has('danger'))
            Toast.fire({
                icon: "error",
                title: "{{ session()->pull('danger') }}"
            });
        @endif
    </script>
@endsection
