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
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            NIK</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            NAMA LENGKAP</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            JABATAN</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            TANGGAL BERGABUNG</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            TANGGAL BERAKHIR</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            STATUS</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
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
                                <p class="text-xs font-weight-bold mb-0">{{ $b->name }}
                                </p>
                            </td>
                            <td class="#">
                                <p class="text-xs font-weight-bold mb-0">{{ $b->jabatan }}
                                </p>
                            </td>
                            <td class="#">
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ \Carbon\Carbon::now()->translatedFormat('d M Y', strtotime($b->tgl_bergabung)) }}
                                </p>
                            </td>
                            <td class="#">
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ \Carbon\Carbon::now()->translatedFormat('d M Y', strtotime($b->tgl_berakhir)) }}
                                </p>
                            </td>
                            <td class="#">
                                @if ($b->is_karyawan === 1)
                                    <label class="badge rounded-pill bg-danger">Non
                                        Aktif</label>
                                @else
                                    <label class="badge rounded-pill bg-success">Aktif</label>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pkwt.edit', $b) }}"
                                    class="btn btn-outline-warning bi bi-pencil-square"></a>

                                <a href="#" class="btn btn-outline-danger btn-action delete bi bi-trash"
                                    data-url="{{ route('pkwt.destroy', $b) }}" data-text="{{ $b->full_name }}"></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Table with hoverable rows -->
    </div>
</div>
