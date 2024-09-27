@extends('layouts.master')

@section('page-title', 'ALL KATEGORI KONTRAK')

@section('breadcrumbs')
    <li class="breadcrumb-item">Roles</li>
    </li>
    <li class="breadcrumb-item active">Kategori Kontrak
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">All Kategori Kontrak</h5>
                        </div>
                        <div class="col-6">
                            <div class="right float-end">
                                <button type="button" class="btn btn-outline-primary" style="margin-top: 12px;"
                                    data-bs-toggle="modal" data-bs-target="#basicModal">
                                    Add Kategori
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kategori Kontrak</th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        ACTION</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            <tbody>
                                @foreach ($KategoriKontrak as $kk)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $no++ }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $kk->kategorikontrak }}</p>
                                        </td>

                                        <td>
                                            <a href="{{ route('kategorikontrak.edit', $kk) }}"
                                                class="btn btn-outline-warning bi bi-pencil-square"></a>
                                            <a href="#" class="btn btn-outline-danger btn-action delete bi bi-trash"
                                                data-url="{{ route('kategorikontrak.destroy', $kk) }}"
                                                data-text="{{ $kk->kategorikontrak }}"></a>

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
        <!-- Modal -->
        <div class="modal fade" id="basicModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Kategori Kontrak</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form action="{{ route('kategorikontrak.store') }}" method="POST">
                                @csrf

                                {{-- Kategori Kontrak --}}

                                <div
                                    class="row mb-3{{ $errors->has('Tidak Bisa Memilih Yang Sudah Ada') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 col-form-label">Kategori Kontrak</label>
                                    <div class="col-sm-10">
                                        <select name="kategorikontrak" class="form-select" id="kategorikontrakSelect"
                                            aria-label="Kategori Kontrak" onchange="handleKategoriChange()">
                                            <option value="">-- Pilih Kategori Kontrak --</option>
                                            @foreach ($KategoriKontrak as $kk)
                                                <option value="{{ $kk->id }}"
                                                    @if (in_array($kk->id, $KategoriKontrak)) disabled @endif>
                                                    {{ $kk->kategorikontrak }}
                                                    @if (in_array($kk->id, $KategoriKontrak))
                                                        - Data Sudah Ada
                                                    @endif
                                                </option>
                                            @endforeach
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        @if ($errors->has('Tidak Bisa Memilih Yang Sudah Ada'))
                                            <span class="help-block" style="color: red;">
                                                {{ $errors->first('Tidak Bisa Memilih Yang Sudah Ada') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3" id="inputLainnya" style="display: none; align-items: center;">
                                    <label for="kategoriLainnya" class=" col-form-label">Kategori Lainnya</label>
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <input name="kategorikontrak" type="text" id="kategoriLainnya"
                                            class="form-control w-75" value="{{ old('kategorikontrak') }}">
                                        @if ($errors->has('kategorikontrak'))
                                            <span class="help-block"
                                                style="color: red;">{{ $errors->first('kategorikontrak') }}</span>
                                        @endif
                                    </div>
                                </div>


                                {{-- <div class="row mb-3" id="inputLainnya" style="display: none;">
                                    <label for="kategoriLainnya" class="col-sm-2 col-form-label">Kategori Lainnya</label>
                                    <div class="col-sm-10">
                                        <input name="kategorikontrak" type="text" id="kategoriLainnya"
                                            class="form-control" value="{{ old('kategorikontrak') }}" required>
                                        @if ($errors->has('kategorikontrak'))
                                            <span class="help-block"
                                                style="color: red;">{{ $errors->first('kategorikontrak') }}</span>
                                        @endif
                                    </div>
                                </div> --}}
                                {{-- Input Manual untuk "Lainnya" --}}
                                {{-- <div class="row mb-3" id="inputLainnya" style="display: none;">
                                    <label for="kategoriLainnya" class="col-sm-2 col-form-label">Kategori Lainnya</label>
                                    <div class="col-sm-10">
                                        <input name="kategorikontrak" type="text" id="kategoriLainnya"
                                            class="form-control" value="{{ old('kategorikontrak') }}" required>
                                        @if ($errors->has('kategorikontrak'))
                                            <span class="help-block"
                                                style="color: red;">{{ $errors->first('kategorikontrak') }}</span>
                                        @endif
                                    </div>
                                </div> --}}

                                <div class="row mb-3">
                                    <button type="submit" class="btn btn-outline-success">Save</button>
                                    <a href="/dashboard" type="button" class="btn btn-outline-primary"
                                        style="margin-top: 12px;">Home</a>
                                    <a href="/eselon" type="button" class="btn btn-outline-warning"
                                        style="margin-top: 12px;">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script_js')
    <script>
        function handleKategoriChange() {
            const selectElement = document.getElementById('kategorikontrakSelect');
            const inputLainnya = document.getElementById('inputLainnya');

            if (selectElement.value === 'Lainnya') {
                inputLainnya.style.display = 'block';
            } else {
                inputLainnya.style.display = 'none';
            }
        }

        $(document).ready(function() {
            $('#datatable').DataTable();
            $('body').on('click', '.delete', function() {
                var book_id = $(this).attr('book-id');
                var eselon = $(this).attr('eselon');

                swal({
                        title: "Are you sure?",
                        text: "The " + eselon + " wants to delete??",
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
                            window.location = "/kategorikontrak" + "/delete/" + book_id;

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
