@extends('layouts.master')

@section('page-title', 'ALL PKWT')
@section('style_css')
    <style>
        .img-priview {
            width: 100%;
            max-width: 300px;
        }
    </style>
@stop


@section('breadcrumbs')
    <li class="breadcrumb-item">Data Master</li>
    <li class="breadcrumb-item active">Edit PKWT Dan Tenaga Ahli</li>
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
    @if (session('sukses'))
        <div class="alert alert-success" role="alert">
            {{ session('sukses') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">EDIT PKWT</h5>
                            @if (Session::has('sukses'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('sukses') }}
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="right float-end">
                                <a href="/pkwt" type="button" class="btn btn-outline-primary" style="margin-top: 12px;">
                                    Back
                                </a>
                            </div>
                            <!-- Basic Modal -->
                        </div>
                    </div>


                    <form action="{{ route('pkwt.update', $pkwt) }}" method="POST" enctype="multipart/form-data"
                        class="row" id="form-update" onsubmit="submitAjax(event)">
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="col-md-8">


                            <!-- NIK -->
                            <div class="row mb-3">
                                <label for="text" class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input name="nik" type="number" class="form-control" id="nik"
                                        aria-describedby="emailHelp" placeholder="NIK Karyawan" value="{{ $pkwt->nik }}">
                                </div>
                            </div>

                            <!-- FULL NAME -->
                            <div class="row mb-3">
                                <label for="text" class="col-sm-2 col-form-label">Full Name</label>
                                <div class="col-sm-9">
                                    <input name="full_name" type="text" class="form-control" id="full_name"
                                        placeholder="FUll nama" value="{{ $pkwt->full_name }}">
                                </div>
                            </div>

                            <!-- Jabatan -->
                            <div class="row mb-3">
                                <label for="text" class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-9">
                                    <input name="jabatan" type="text" id="jabatan" class="form-control" id="jabatan"
                                        placeholder="jabatan" value="{{ $pkwt->jabatan }}">
                                </div>
                            </div>

                            {{-- Kategori Kontrak --}}
                            <div class="row mb-3">
                                <label for="text" class="col-sm-2 col-form-label">Kategori Kontrak</label>
                                <div class="col-sm-9">
                                    <select name="id_kategorikontrak" id="kategorikontrak" class="form-control" required>
                                        <option value="">Pilih Kategori Kontrak</option> {{-- Menambahkan opsi untuk memilih kategori --}}
                                        @foreach ($kategorikontrak as $kk)
                                            <option value="{{ $kk->id }}"
                                                @if ($kk->id == $pkwt->id_kategorikontrak) selected='selected' @endif>
                                                {{ $kk->kategorikontrak ?? 'Tidak Ada Kategori Dipilih' }}</option>
                                        @endforeach
                                    </select>

                                    {{-- Notifikasi jika id_kategorikontrak belum terisi --}}
                                    <div id="notification" class="alert alert-danger mt-2"
                                        style="display: {{ is_null($pkwt->id_kategorikontrak) ? 'block' : 'none' }}">
                                        Data Kategori Kontrak Wajib Terisi.
                                    </div>
                                </div>
                            </div>

                            {{-- Tanggal Lahir Karyawan --}}
                            <div class="row mb-3">
                                <label for="text" class="col-sm-2 col-form-label">Tanggal Bergabung</label>
                                <div class="col-sm-9">
                                    <input name="tgl_bergabung" type="date" id="tgl_bergabung" class="form-control"
                                        id="tgl_bergabung" placeholder="tgl_bergabung" value="{{ $pkwt->tgl_bergabung }}">
                                </div>
                            </div>

                            {{-- CALON KARYAWAN --}}
                            <div class="row mb-3">
                                <label for="text" class="col-sm-2 col-form-label">Tanggal Berakhir</label>
                                <div class="col-sm-9">
                                    <input name="tgl_berakhir" type="date" id="tgl_berakhir" class="form-control"
                                        id="tgl_berakhir" placeholder="tgl_berakhir" value="{{ $pkwt->tgl_berakhir }}">
                                </div>
                            </div>

                            <!-- foto -->
                            <div class="row mb-2">
                                <label for="formFileSm" class="col-sm-2 col-form-label">Profil Karyawan</label>

                                <div class="col-sm-9">
                                    <input name="formFileSm" type="file" class="form-control" id="formFileSm"
                                        value="{{ $pkwt->formFileSm }}" onchange="previewImage()">
                                </div>

                            </div>

                        </div>
                        <div class="col-md-4">
                            @if ($pkwt->formFileSm)
                                <img src="{{ asset('storage/' . $pkwt->formFileSm) }}" class="img-priview"
                                    id="img-foto">
                            @else
                                <img class="img-priview" id="img-foto">
                            @endif
                            <button type="button" class="btn btn-outline-danger" style="display: none" id="btn-reset"
                                onclick="resetImage()"> Reset Foto </button>
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
@endsection
@section('sweetalert')
    <script>
        document.getElementById('kategorikontrak').addEventListener('change', function() {
            var notification = document.getElementById('notification');
            // Cek apakah ada opsi yang dipilih
            if (this.value) {
                notification.style.display = 'none'; // Sembunyikan notifikasi
            } else {
                notification.style.display = 'block'; // Tampilkan notifikasi
            }
        });
        const img_asli = "{{ asset('storage/' . $pkwt->formFileSm) }}";

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
                    location.href = "{{ url('/pkwt') }}"
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
    </script>
@endsection
