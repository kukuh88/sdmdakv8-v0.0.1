public function approvel_kenaikan(Request $request, Karyawan $karyawan)
{
$request->validate([
'status' => ['required', 'integer', 'in:0,1,2'],
'keterangan' => ['nullable', 'string'],
'golonganini' => ['required', 'integer'],
'golongannaik' => ['required', 'integer'],
]);

$book = $karyawan->book;

$approvel = ApprovelKenaikan::firstOrCreate([
'id_karyawan' => $book->id_karyawan,
'golonganini' => $request->golonganini,
'golongannaik' => $request->golongannaik,
]);


$attributes['status'] = $request->status;

if($request->status == 1) {
$attributes['approved_at'] = date('Y-m-d H:i:s');
$attributes['approved_by'] = auth()->user()->id;
$eselon = Eselon::where('eselon', $book->eselon)->first();

$book->golonganini = $request->golongannaik;
$book->golongan = $request->golongannaik + 1;
$book->tmt_golonganini = $book->tmt_golongan;

if ($book->golonganini < $eselon->min_gol){
    $book->is_pilihan = 1;
    }

    if ($book->golongannaik < $eselon->max_gol) {
        $tmt_golini = Carbon::parse($book->tmt_golonganini);
        if ($book->is_pilihan === 1){
        $book->tmt_golongan = $tmt_golini->addYears(1)->format('Y-m-d');
        } else {
        $book->tmt_golongan = $tmt_golini->addYears(4)->format('Y-m-d');
        }
        }
        } else{
        $attributes['keterangan'] = $request->keterangan;
        }

        $approvel->update($attributes);

        $book->last_approval_id = $approvel->id;
        $book->update();
        $karyawan->last_approval_id = $approvel->id;
        $karyawan->update();

        return response()->json([
        'status' => 'success',
        'title' => 'Berhasil !',
        'message' => 'Data Karyawan berhasil di update',
        ], 200);
        }


        ------------------- SALAH ------------------
        // public function approvel_kenaikan(Request $request, Book $karyawan)
        // {
        // $request->validate([
        // 'status' => ['required', 'integer', 'in:0,1,2'],
        // 'keterangan' => ['nullable', 'string'],
        // 'golonganini' => ['required', 'integer'],
        // 'golongannaik' => ['required', 'integer'],
        // ]);

        // baru
        // $book = $karyawan->book();

        // $approvel = ApprovelKenaikan::firstOrCreate([
        // 'id_karyawan' => $karyawan->id_karyawan, sebelumnya sebelah kiri setelahnya di bawah ini
        // 'id_karyawan' => $book->id_karyawan,
        // 'golonganini' => $request->golonganini,
        // 'golongannaik' => $request->golongannaik,
        // ]);

        // $attributes['status'] = $request->status;

        // if($request->status == 1) {
        // $attributes['approved_at'] = date('Y-m-d H:i:s');
        // $attributes['approved_by'] = auth()->user()->id;
        // $eselon = Eselon::where('eselon', $karyawan->eselon)->first();

        // bagian salah semua ini
        // $karyawan->golonganini = $request->golongannaik;
        // $karyawan->golongan = $request->golongannaik + 1;
        // $karyawan->tmt_golonganini = $karyawan->tmt_golongan;

        // if ($request->golonganini < $eselon->min_gol){
            // $karyawan->is_pilihan = 1;
            // }

            // if ($karyawan->golongannaik < $eselon->max_gol) {
                // $tmt_golini = Carbon::parse($karyawan->tmt_golonganini);
                // if ($karyawan->is_pilihan === 1){
                // $karyawan->tmt_golongan = $tmt_golini->addYears(1);
                // } else {
                // $karyawan->tmt_golongan = $tmt_golini->addYears(4);
                // }
                // }
                // } else{
                // $attributes['keterangan'] = $request->keterangan;
                // }

                // bagian di updatenya
                // $book->golonganini = $request->golongannaik;
                // $book->golongan = $request->golongannaik + 1;
                // $book->tmt_golonganini = $book->tmt_golongan;

                // if ($request->golonganini < $eselon->min_gol){
                    // $book->is_pilihan = 1;
                    // }

                    // if ($book->golongannaik < $eselon->max_gol) {
                        // $tmt_golini = Carbon::parse($book->tmt_golonganini);
                        // if ($book->is_pilihan === 1){
                        // $book->tmt_golongan = $tmt_golini->addYears(1);
                        // } else {
                        // $book->tmt_golongan = $tmt_golini->addYears(4);
                        // }
                        // }
                        // } else{
                        // $attributes['keterangan'] = $request->keterangan;
                        // }
                        // $approvel->update($attributes);
                        // // di tambah bagian booknya
                        // $book->last_approval_id = $approvel->id;
                        // $book->update();
                        // // sebelumnya cuma karyawan saja di update
                        // $karyawan->last_approval_id = $approvel->id;
                        // $karyawan->update();
                        // Karyawan::where('id', $approvel['id_karyawan'])
                        // ->update([
                        // 'last_approval_id' => $approvel->id,
                        // ]);

                        // return response()->json([
                        // 'status' => 'success',
                        // 'title' => 'Berhasil !',
                        // 'message' => 'Data Karyawan berhasil di update',
                        // ], 200);
                        // }
