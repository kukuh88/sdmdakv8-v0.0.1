<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NIK</th>
            <th>FULL NAME</th>
            <th>JABATAN</th>
            <th>TGL LAHIR</th>
            <th>CAKAR</th>
            <th>FOTO PEGAWAI</th>
            <th>CREATED AT</th>
            <th>UPDATE AT</th>
            <th>PP</th>
            <th>NPP1</th>
            <th>P1A</th>
            <th>NP2</th>
            <th>P2A</th>
            <th>TTP</th>
            <th>NPP</th>
            <th>NPP2</th>
            <th>ID KARYAWAN</th>
            <th>GOLONGAN SAAT INI</th>
            <th>TMT GOLONGAN SAAT INI</th>
            <th>GOLONGAN MENDATANG</th>
            <th>TMT GOLONGAN MENDATANG</th>
            <th>ESELON</th>
            <th>TMT ESELON</th>
            <th>STATUS</th>
            <th>HOLD</th>
            <th>KET HOLD</th>
        </tr>
    </thead>
    @php
        $no = 1;
    @endphp
    <tbody>
        @foreach ($book as $k)
            <tr>
                {{-- nomor urut --}}
                <td>{{ $no++ }}</td>
                {{-- nik --}}
                <td>{{ $k->karyawan->nik }}</td>
                {{-- nama --}}
                <td>{{ $k->karyawan->name }}</td>
                {{-- jabatan --}}
                <td>{{ $k->karyawan->jabatan }}</td>
                {{-- tgl_lahir --}}
                <td>{{ $k->karyawan->tgl_lahir }}</td>
                {{-- cakar --}}
                <td>{{ $k->karyawan->cakar }}</td>
                {{-- foto --}}
                <td></td>
                {{-- created_at --}}
                <td>{{ $k->created_at }}</td>
                {{-- update_at --}}
                <td>{{ $k->update_at }}</td>
                {{-- pp --}}
                <td></td>
                {{-- NPP1 --}}
                <td></td>
                {{-- P1A --}}
                <td></td>
                {{-- NP2 --}}
                <td></td>
                {{-- P2A --}}
                <td></td>
                {{-- TTP --}}
                <td></td>
                {{-- NPP --}}
                <td>{{ $k->karyawan->tanggal_terakhir_pensiun }}</td>
                {{-- NPP2 --}}
                <td>{{ $k->karyawan->notifikasi_peringatan_pada }}</td>
                {{-- id_karyawan --}}
                <td>{{ $k->id_karyawan }}</td>
                {{-- golongan saat ini --}}
                <td>{{ $k->golonganini }}</td>
                {{-- tmt golongan saat ini --}}
                <td>{{ $k->tmt_golonganini }}</td>
                {{-- golongan mendatang --}}
                <td>{{ $k->golongan }}</td>
                {{-- tmt_golongan mendatang --}}
                <td>{{ $k->tmt_golongan }}</td>
                {{-- eselon --}}
                <td>{{ $k->eselon }}</td>
                {{-- tmt eselon --}}
                <td>{{ $k->tmt_eselon }}</td>
                {{-- status --}}
                <td>{{ $k->status }}</td>
                {{-- hold --}}
                <td>{{ $k->hold }}</td>
                {{-- keterangan di hold --}}
                <td>{{ $k->ket_hold }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
