@extends('layouts.master')

@section('page-title', 'ALL ESELON')

@section('breadcrumbs')
    <li class="breadcrumb-item">Roles</li>
    </li>
    <li class="breadcrumb-item active">Eselon</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">All Eselon</h5>
                        </div>
                        <div class="col-6">
                            <div class="right float-end">
                                <button type="button" class="btn btn-outline-primary" style="margin-top: 12px;"
                                    data-bs-toggle="modal" data-bs-target="#basicModal">
                                    Add Eselon
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
                                        ESELON</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        MIN GOLONGAN</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        MAX GOLONGAN</th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        ACTION</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            <tbody>
                                @foreach ($eselon as $s)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $no++ }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $s->eselon }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $s->min_gol }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $s->max_gol }}</p>
                                        </td>

                                        <td>
                                            <a href="{{ route('eselon.edit', $s) }}"
                                                class="btn btn-outline-warning bi bi-pencil-square"></a>
                                            <a href="#" class="btn btn-outline-danger btn-action delete bi bi-trash"
                                                data-url="{{ route('eselon.destroy', $s) }}"
                                                data-text="{{ $s->eselon }}"></a>

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
                        <h5 class="modal-title">Add Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <!-- General Form Elements -->
                            <form action="{{ route('eselon.store') }}" method="POST">
                                @csrf

                                {{-- ESELON --}}
                                <div class="row mb-3{{ $errors->has('eselon') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 col-form-label">Kategori Barang</label>
                                    <div class="col-sm-10">
                                        <select name="eselon" class="form-select" id="floatingSelect"
                                            aria-label="Floating label select example">
                                            <option value="2A"{{ old('2A') == '2A' ? 'selected' : '' }}>2A
                                            </option>
                                            <option value="2B"{{ old('2B') == '2B' ? 'selected' : '' }}>
                                                2B
                                            </option>
                                            <option value="2C"{{ old('2C') == '2C' ? 'selected' : '' }}>
                                                2C</option>
                                            <option value="3A"{{ old('3A') == '3A' ? 'selected' : '' }}>
                                                3A</option>
                                            <option value="3B"{{ old('3B') == '3B' ? 'selected' : '' }}>
                                                3B</option>
                                            <option value="3C"{{ old('3C') == '3C' ? 'selected' : '' }}>
                                                3C</option>
                                            <option value="4A"{{ old('4A') == '4A' ? 'selected' : '' }}>
                                                4A</option>
                                            <option value="4B"{{ old('4B') == '4B' ? 'selected' : '' }}>
                                                4B</option>
                                            <option value="4C"{{ old('4C') == '4C' ? 'selected' : '' }}>
                                                4C</option>
                                            <option value="5A"{{ old('5A') == '5A' ? 'selected' : '' }}>
                                                5A</option>
                                            <option value="5B"{{ old('5B') == '5B' ? 'selected' : '' }}>
                                                5B</option>
                                            <option value="5C"{{ old('5C') == '5C' ? 'selected' : '' }}>
                                                5C</option>
                                            <option value="6A"{{ old('6A') == '6A' ? 'selected' : '' }}>
                                                6A</option>
                                            <option value="6B"{{ old('6B') == '6B' ? 'selected' : '' }}>
                                                6B</option>
                                            <option value="7A"{{ old('7A') == '7A' ? 'selected' : '' }}>
                                                7A</option>
                                            <option value="7B"{{ old('7B') == '7B' ? 'selected' : '' }}>
                                                7B</option>
                                            <option value="NE"{{ old('NE') == 'NE' ? 'selected' : '' }}>
                                                NE</option>

                                        </select>
                                        @if ($errors->has('eselon'))
                                            <span class="help-block"
                                                style="color: red;">{{ $errors->first('eselon') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Min Golongan --}}
                                <div class="row mb-3{{ $errors->has('min_gol') ? ' has-error' : '' }}">
                                    <label for="min_gol" class="col-sm-2 col-form-label">Min Gol</label>
                                    <div class="col-sm-10">
                                        <input name="min_gol" type="number" id="min_gol" class="form-control"
                                            value="{{ old('min_gol') }}" required>
                                        @if ($errors->has('min_gol'))
                                            <span class="help-block"
                                                style="color: red;">{{ $errors->first('min_gol') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Max Golongan --}}
                                <div class="row mb-3{{ $errors->has('max_gol') ? ' has-error' : '' }}">
                                    <label for="min_gol" class="col-sm-2 col-form-label">Max Gol</label>
                                    <div class="col-sm-10">
                                        <input name="max_gol" type="number" id="max_gol" class="form-control"
                                            value="{{ old('max_gol') }}" required>
                                        @if ($errors->has('max_gol'))
                                            <span class="help-block"
                                                style="color: red;">{{ $errors->first('max_gol') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="/dashboard" type="button" class="btn btn-primary"
                                        style="margin-top: 12px;">
                                        Home
                                    </a>
                                    <a href="/eselon" type="button" class="btn btn-primary" style="margin-top: 12px;">
                                        Back
                                    </a>
                                </div>
                        </div>
                        </form><!-- End General Form Elements -->
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
                            window.location = "/eselon" + "/delete/" + book_id;

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
