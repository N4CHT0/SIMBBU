<?php

namespace App\Http\Controllers;

use App\Models\DiklatSOUR;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class DiklatSOURController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DiklatSOUR::orderBy('nama_lengkap', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            return view('diklat_soum.button',compact('data'));
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
            'nama_instansi' => 'required',
            'status' => 'required',
            'agama' => 'required',
            'no_telp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'jenis_kelamin' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'foto' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
            'scan_foto_akte' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
            'scan_foto_ktp' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
            'scan_foto_ijazah' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
            'scan_foto_npwp' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
            'alamat' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ibu' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'penghasilan_ayah' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama Lengkap Wajib Di Isi',
            'nik.required' => 'NIK Wajib Di Isi',
            'npwp.required' => 'NPWP Wajib Di Isi',
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
            'pekerjaan.required' => 'Pekerjaan Wajib Di Isi',
            'nama_ibu.required' => 'Nama Ibu Wajib Di Isi',
            'pekerjaan_ibu.required' => 'Pekerjaan Ibu Wajib Di Isi',
            'penghasilan_ibu.required' => 'Penghasilan Ibu Wajib Di Isi',
            'nama_ayah.required' => 'Nama Ayah Wajib Di Isi',
            'pekerjaan_ayah.required' => 'Pekerjaan Ayah Wajib Di Isi',
            'penghasilan_ayah.required' => 'Penghasilan Ayah Wajib Di Isi',
            'nama_instansi.required' => 'Nama Instansi Wajib Di Isi',
            'foto.required' => 'Foto Wajib Diupload',
            'scan_foto_ktp.required' => 'Scan/Foto KTP Wajib Diupload',
            'scan_foto_npwp.required' => 'Scan/Foto NPWP Wajib Diupload',
            'scan_foto_ijazah.required' => 'Scan/Foto Ijazah Wajib Diupload',
            'scan_foto_akte.required' => 'Scan/Foto Akte Wajib Diupload',
            'alamat.required' => 'Alamat Wajib Diupload',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'nama_instansi' => $request->nama_instansi,
            'no_telp' => $request->no_telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'status' => $request->status,
            'agama' => $request->agama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nik' => $request->nik,
            'npwp' => $request->npwp,
            'pekerjaan' => $request->pekerjaan,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'provinsi' => $request->provinsi,
            'kabupaten_kota' => $request->kabupaten_kota,
            'kecamatan' => $request->kecamatan,
            'alamat' => $request->alamat,
        ];

        // Simpan file foto jika ada
        $this->processImageUpload($request, 'foto', $data);
        $this->processImageUpload($request, 'scan_foto_ktp', $data);
        $this->processImageUpload($request, 'scan_foto_akte', $data);
        $this->processImageUpload($request, 'scan_foto_ijazah', $data);
        $this->processImageUpload($request, 'scan_foto_npwp', $data);

        DiklatSOUR::create($data);
        return response()->json(['success' => "Berhasil Menyimpan Data"]);
    }

    private function processImageUpload($request, $fieldName, &$data, $model = null)
    {
        if ($request->hasFile($fieldName)) {
            $image = $request->file($fieldName);
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/img', $imageName);

            // Hapus file lama jika sedang melakukan update
            if ($model && $model->$fieldName) {
                Storage::delete('public/img/' . $model->$fieldName);
            }

            // Tambahkan nama file ke data
            $data[$fieldName] = $imageName;
        } elseif ($model && $model->$fieldName) {
            // Jika tidak ada file baru diupload, tetapi ada file lama, gunakan file lama
            $data[$fieldName] = $model->$fieldName;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DiklatSOUR::where('id', $id)->first();
        return response()->json(['result'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DiklatSOUR::where('id', $id)->first();
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
            $model = DiklatSOUR::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['errors' => ['Data tidak ditemukan']], 404);
        }

        // Validasi data seperti pada fungsi update
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:diklat_m_c,email,' . $id,
            'status' => 'required',
            'nik' => 'required',
            'npwp' => 'required',
            'nama_instansi' => 'required',
            'no_telp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'pekerjaan' => 'required',
            'foto' => $request->hasFile('foto') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'scan_foto_ktp' => $request->hasFile('scan_foto_ktp') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'scan_foto_npwp' => $request->hasFile('scan_foto_npwp') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'scan_foto_akte' => $request->hasFile('scan_foto_akte') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'scan_foto_ijazah' => $request->hasFile('scan_foto_ijazah') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'alamat' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ibu' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'penghasilan_ayah' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama Lengkap Wajib Di Isi',
            'nik.required' => 'NIK Wajib Di Isi',
            'npwp.required' => 'NPWP Wajib Di Isi',
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
            'pekerjaan.required' => 'Pekerjaan Wajib Di Isi',
            'nama_ibu.required' => 'Nama Ibu Wajib Di Isi',
            'pekerjaan_ibu.required' => 'Pekerjaan Ibu Wajib Di Isi',
            'penghasilan_ibu.required' => 'Penghasilan Ibu Wajib Di Isi',
            'nama_ayah.required' => 'Nama Ayah Wajib Di Isi',
            'pekerjaan_ayah.required' => 'Pekerjaan Ayah Wajib Di Isi',
            'penghasilan_ayah.required' => 'Penghasilan Ayah Wajib Di Isi',
            'nama_instansi.required' => 'Nama Instansi Wajib Di Isi',
            'foto.required' => 'Foto Wajib Diupload',
            'scan_foto_ktp.required' => 'Scan/Foto KTP Wajib Diupload',
            'scan_foto_npwp.required' => 'Scan/Foto NPWP Wajib Diupload',
            'scan_foto_ijazah.required' => 'Scan/Foto Ijazah Wajib Diupload',
            'scan_foto_akte.required' => 'Scan/Foto Akte Wajib Diupload',
            'alamat.required' => 'Alamat Wajib Diupload',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        // Inisialisasi $data
        $data = [];
        // Simpan file foto jika ada
        $this->processImageUpload($request, 'foto', $data, $model);
        $this->processImageUpload($request, 'scan_foto_ktp', $data, $model);
        $this->processImageUpload($request, 'scan_foto_akte', $data, $model);
        $this->processImageUpload($request, 'scan_foto_ijazah', $data, $model);
        $this->processImageUpload($request, 'scan_foto_npwp', $data, $model);


        // Update data
        $model->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nama_instansi' => $request->nama_instansi,
            'no_telp' => $request->no_telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'status' => $request->status,
            'agama' => $request->agama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nik' => $request->nik,
            'npwp' => $request->npwp,
            'pekerjaan' => $request->pekerjaan,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'provinsi' => $request->provinsi,
            'kabupaten_kota' => $request->kabupaten_kota,
            'kecamatan' => $request->kecamatan,
            'alamat' => $request->alamat,
            'foto' => $data['foto'] ?? $model->foto, // Pastikan atribut sesuai dengan kolom di tabel
            'scan_foto_ktp' => $data['scan_foto_ktp'] ?? $model->scan_foto_ktp,
            'scan_foto_akte' => $data['scan_foto_akte'] ?? $model->scan_foto_akte,
            'scan_foto_ijazah' => $data['scan_foto_ijazah'] ?? $model->scan_foto_ijazah,
            'scan_foto_npwp' => $data['scan_foto_npwp'] ?? $model->scan_foto_npwp,
            ]);

        return response()->json(['success' => 'Berhasil Melakukan Update Data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = DiklatSOUR::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }

        // Hapus semua file terkait
        $this->deleteRelatedFiles($data);

        // Hapus data dari basis data
        $data->delete();

        return response()->json(['success' => 'Berhasil menghapus data.']);
    }

    private function deleteRelatedFiles($data)
    {
        $fileFields = ['foto', 'scan_foto_ktp', 'scan_foto_akte', 'scan_foto_ijazah'];

        foreach ($fileFields as $fieldName) {
            if ($data->$fieldName) {
                Storage::delete('public/img/' . basename($data->$fieldName));
            }
        }
    }
}
