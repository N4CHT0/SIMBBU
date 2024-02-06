<?php

namespace App\Http\Controllers;

use App\Models\DiklatSATSDSD;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class DiklatSATSDSDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DiklatSATSDSD::orderBy('nama_lengkap', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            return view('diklat_satsdsd.button',compact('data'));
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:diklat_m_c,email,' . $request->id,
            'seafare_code' => 'required',
            'status' => 'required',
            'agama' => 'required',
            'no_telp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_sertifikat_cop' => 'required',
            'jenis_kelamin' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan_desa' => 'required',
            'rt_rw' => 'required',
            'kode_pos' => 'required',
            'pekerjaan' => 'required',
            'foto' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'alamat' => 'required',
            'nama_ibu' => 'required',
            'nama_ayah' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama Lengkap Wajib Di Isi',
            'jenis_sertifikat_cop.required' => 'Jenis Sertifikat COP Wajib Di Isi',
            'email.email' => 'Format Email Harus Benar',
            'email.required' => 'Email Wajib Di Isi',
            'tempat_lahir.required' => 'Tempat Lahir Wajib Di Isi',
            'no_telp.required' => 'Nomor Telepon Wajib Di Isi',
            'tanggal_lahir.required' => 'Tanggal Lahir Wajib Di Isi',
            'status.required' => 'Status Wajib Di Isi',
            'agama.required' => 'Agama Wajib Di Isi',
            'provinsi.required' => 'provinsi Wajib Di Isi',
            'kabupaten_kota.required' => 'kabupaten_kota Wajib Di Isi',
            'kecamatan.required' => 'Kecamatan Wajib Di Isi',
            'kelurahan_desa.required' => 'Kelurahan/Desa Wajib Di Isi',
            'rt_rw.required' => 'RT/RW Wajib Di Isi',
            'kode_pos.required' => 'Kode Pos Wajib Di Isi',
            'pekerjaan.required' => 'Pekerjaan Wajib Di Isi',
            'nama_ibu.required' => 'Nama Ibu Wajib Di Isi',
            'nama_ayah.required' => 'Nama Ayah Wajib Di Isi',
            'seafare_code.required' => 'Seafare Code Wajib Di Isi',
            'foto.required' => 'Foto Wajib Diupload',
            'alamat.required' => 'Alamat Wajib Diupload',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'seafare_code' => $request->seafare_code,
            'no_telp' => $request->no_telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'status' => $request->status,
            'agama' => $request->agama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jenis_sertifikat_cop' => $request->jenis_sertifikat_cop,
            'pekerjaan' => $request->pekerjaan,
            'kode_pos' => $request->kode_pos,
            'nama_ibu' => $request->nama_ibu,
            'nama_ayah' => $request->nama_ayah,
            'provinsi' => $request->provinsi,
            'kabupaten_kota' => $request->kabupaten_kota,
            'rt_rw' => $request->rt_rw,
            'kecamatan' => $request->kecamatan,
            'kelurahan_desa' => $request->kelurahan_desa,
            'alamat' => $request->alamat,
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/img', $fotoName);

            // Tambahkan nama file ke data
            $data['foto'] = $fotoName;
        }

        DiklatSATSDSD::create($data);
        return response()->json(['success' => "Berhasil Menyimpan Data"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DiklatSATSDSD::where('id', $id)->first();
        return response()->json(['result'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DiklatSATSDSD::where('id', $id)->first();
        return response()->json(['result'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        logger($request->all());

        try {
            // Temukan data berdasarkan ID
            $model = DiklatSATSDSD::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['errors' => ['Data tidak ditemukan']], 404);
        }

        // Validasi data seperti pada fungsi update
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:diklat_m_c,email,' . $id,
            'seafare_code' => 'required',
            'status' => 'required',
            'no_telp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_sertifikat_cop' => 'required',
            'jenis_kelamin' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan_desa' => 'required',
            'kode_pos' => 'required',
            'pekerjaan' => 'required',
            'foto' => $request->hasFile('foto') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:4048' : '',
            'alamat' => 'required',
            'nama_ibu' => 'required',
            'nama_ayah' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama Lengkap Wajib Di Isi',
            'jenis_sertifikat_cop.required' => 'Jenis Sertifikat COP Wajib Di Isi',
            'email.email' => 'Format Email Harus Benar',
            'email.required' => 'Email Wajib Di Isi',
            'tempat_lahir.required' => 'Tempat Lahir Wajib Di Isi',
            'no_telp.required' => 'Nomor Telepon Wajib Di Isi',
            'tanggal_lahir.required' => 'Tanggal Lahir Wajib Di Isi',
            'status.required' => 'Status Wajib Di Isi',
            'provinsi.required' => 'provinsi Wajib Di Isi',
            'kabupaten_kota.required' => 'kabupaten_kota Wajib Di Isi',
            'kecamatan.required' => 'Kecamatan Wajib Di Isi',
            'kelurahan_desa.required' => 'Kelurahan/Desa Wajib Di Isi',
            'rt_rw.required' => 'RT/RW Wajib Di Isi',
            'kode_pos.required' => 'Kode Pos Wajib Di Isi',
            'pekerjaan.required' => 'Pekerjaan Wajib Di Isi',
            'nama_ibu.required' => 'Nama Ibu Wajib Di Isi',
            'nama_ayah.required' => 'Nama Ayah Wajib Di Isi',
            'seafare_code.required' => 'Seafare Code Wajib Di Isi',
            'foto.required' => 'Foto Wajib Diupload',
            'alamat.required' => 'Alamat Wajib Diupload',
            'agama.required' => 'Agama Wajib Diupload',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        $fotoName = null;
        // Simpan file foto jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/img', $fotoName);

            // Hapus foto lama jika ada
            if ($model->foto) {
                Storage::delete('public/img/' . $model->foto);
            }

            // Update nama file foto dalam data
            $model->foto = $fotoName;
        } elseif ($model->foto) {
            // Jika tidak ada foto baru, tetapi ada foto lama, gunakan foto lama
            $fotoName = $model->foto;
        }


        // Update data
        $model->update([
            'nama_lengkap' => $request->nama_lengkap,
            'seafare_code' => $request->seafare_code,
            'status' => $request->status,
            'no_telp' => $request->no_telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'agama' => $request->agama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jenis_diklat_cop' => $request->jenis_diklat_cop,
            'pekerjaan' => $request->pekerjaan,
            'kode_pos' => $request->kode_pos,
            'nama_ibu' => $request->nama_ibu,
            'nama_ayah' => $request->nama_ayah,
            'provinsi' => $request->provinsi,
            'kabupaten_kota' => $request->kabupaten_kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan_desa' => $request->kelurahan_desa,
            'rt_rw' => $request->rt_rw,
            'alamat' => $request->alamat,
            'foto' => $fotoName,
            // ... (tambahkan semua kolom lainnya)
        ]);

        return response()->json(['success' => 'Berhasil Melakukan Update Data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DiklatSATSDSD::find($id);
        if ($data) {
            // Hapus file terkait jika ada
            if ($data->foto) {
                Storage::delete('public/img/' . basename($data->foto));
            }
            // Hapus data dari basis data
            $data->delete();
            return response()->json(['success' => 'Berhasil menghapus data.']);
        } else {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }
}
