<?php

namespace App\Http\Controllers;

use App\Models\PerpanjanganSertifikatSOU;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class PerpanjanganSertifikatSOUController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PerpanjanganSertifikatSOU::orderBy('nama_lengkap', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            return view('perpanjangan_sertifikat_sou.button',compact('data'));
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
            'email' => 'required',
            'jenis_sertifikat' => 'required',
            'no_sertifikat' => 'required',
            'no_telp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'npwp' => 'required',
            'jenis_kelamin' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan_desa' => 'required',
            'foto' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
            'scan_foto_npwp' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
            'scan_foto_sertifikat' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
            'scan_foto_ijazah' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
            'alamat' => 'required',
            'agama' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama Lengkap Wajib Di Isi',
            'nik.required' => 'NIK Wajib Di Isi',
            'npwp.required' => 'NPWP Wajib Di Isi',
            'email.email' => 'Format Email Harus Benar',
            'email.required' => 'Email Wajib Di Isi',
            'tempat_lahir.required' => 'Tempat Lahir Wajib Di Isi',
            'no_telp.required' => 'Nomor Telepon Wajib Di Isi',
            'tanggal_lahir.required' => 'Tanggal Lahir Wajib Di Isi',
            'no_sertifikat.required' => 'Nomor Sertifikat Wajib Di Isi',
            'provinsi.required' => 'Provinsi Wajib Di Isi',
            'kabupaten_kota.required' => 'kabupaten_kota Wajib Di Isi',
            'kecamatan.required' => 'Kecamatan Wajib Di Isi',
            'kelurahan_desa.required' => 'Kelurahan/Desa Wajib Di Isi',
            'jenis_sertifikat.required' => 'Jenis Sertifikat Wajib Di Isi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib Di Isi',
            'foto.required' => 'Foto Wajib Diupload',
            'scan_foto_npwp.required' => 'Scan/Foto NPWP Wajib Diupload',
            'scan_foto_ijazah.required' => 'Scan/Foto Ijazah Wajib Diupload',
            'scan_foto_sertifikat.required' => 'Scan/Foto Sertifikat Wajib Diupload',
            'alamat.required' => 'Alamat Wajib Di Isi',
            'agama.required' => 'Agama Wajib Di Isi',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_sertifikat' => $request->jenis_sertifikat,
            'no_telp' => $request->no_telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'agama' => $request->agama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nik' => $request->nik,
            'npwp' => $request->npwp,
            'no_sertifikat' => $request->no_sertifikat,
            'provinsi' => $request->provinsi,
            'kabupaten_kota' => $request->kabupaten_kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan_desa' => $request->kelurahan_desa,
            'alamat' => $request->alamat,
        ];

        // Simpan file foto jika ada
        $this->processImageUpload($request, 'foto', $data);
        $this->processImageUpload($request, 'scan_foto_sertifikat', $data);
        $this->processImageUpload($request, 'scan_foto_npwp', $data);
        $this->processImageUpload($request, 'scan_foto_ijazah', $data);

        PerpanjanganSertifikatSOU::create($data);
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
        $data = PerpanjanganSertifikatSOU::where('id', $id)->first();
        return response()->json(['result'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = PerpanjanganSertifikatSOU::where('id', $id)->first();
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
            $model = PerpanjanganSertifikatSOU::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['errors' => ['Data tidak ditemukan']], 404);
        }

        // Validasi data seperti pada fungsi update
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'email' => 'required',
            'jenis_sertifikat' => 'required',
            'no_sertifikat' => 'required',
            'no_telp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'npwp' => 'required',
            'jenis_kelamin' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan_desa' => 'required',
            'foto' => $request->hasFile('foto') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'scan_foto_npwp' => $request->hasFile('scan_foto_npwp') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'scan_foto_ijazah' => $request->hasFile('scan_foto_ijazah') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'scan_foto_sertifikat' => $request->hasFile('scan_foto_sertifikat') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'alamat' => 'required',
            'agama' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama Lengkap Wajib Di Isi',
            'nik.required' => 'NIK Wajib Di Isi',
            'npwp.required' => 'NPWP Wajib Di Isi',
            'email.email' => 'Format Email Harus Benar',
            'email.required' => 'Email Wajib Di Isi',
            'tempat_lahir.required' => 'Tempat Lahir Wajib Di Isi',
            'no_telp.required' => 'Nomor Telepon Wajib Di Isi',
            'tanggal_lahir.required' => 'Tanggal Lahir Wajib Di Isi',
            'no_sertifikat.required' => 'Nomor Sertifikat Wajib Di Isi',
            'provinsi.required' => 'provinsi Wajib Di Isi',
            'kabupaten_kota.required' => 'kabupaten_kota Wajib Di Isi',
            'kecamatan.required' => 'Kecamatan Wajib Di Isi',
            'kelurahan_desa.required' => 'Kelurahan/Desa Wajib Di Isi',
            'jenis_sertifikat.required' => 'Jenis Sertifikat Wajib Di Isi',
            'foto.required' => 'Foto Wajib Diupload',
            'scan_foto_npwp.required' => 'Scan/Foto NPWP Wajib Diupload',
            'scan_foto_sertifikat.required' => 'Scan/Foto Sertifikat Wajib Diupload',
            'scan_foto_ijazah.required' => 'Scan/Foto Ijazah Wajib Diupload',
            'alamat.required' => 'Alamat Wajib Di Isi',
            'agama.required' => 'Agama Wajib Di Isi',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        // Inisialisasi $data
        $data = [];
        // Simpan file foto jika ada
        $this->processImageUpload($request, 'foto', $data, $model);
        $this->processImageUpload($request, 'scan_foto_npwp', $data, $model);
        $this->processImageUpload($request, 'scan_foto_ijazah_laut', $data, $model);
        $this->processImageUpload($request, 'scan_foto_sertifikat', $data, $model);


        // Update data
        $model->update([
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_sertifikat' => $request->jenis_sertifikat,
            'no_telp' => $request->no_telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'agama' => $request->agama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nik' => $request->nik,
            'npwp' => $request->npwp,
            'no_sertifikat' => $request->no_sertifikat,
            'provinsi' => $request->provinsi,
            'kabupaten_kota' => $request->kabupaten_kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan_desa' => $request->kelurahan_desa,
            'alamat' => $request->alamat,
            'foto' => $data['foto'] ?? $model->foto, // Pastikan atribut sesuai dengan kolom di tabel
            'scan_foto_ijazah' => $data['scan_foto_ijazah'] ?? $model->scan_foto_ijazah,
            'scan_foto_npwp' => $data['scan_foto_npwp'] ?? $model->scan_foto_npwp,
            'scan_foto_sertifikat' => $data['scan_foto_sertifikat'] ?? $model->scan_foto_sertifikat,
            ]);

        return response()->json(['success' => 'Berhasil Melakukan Update Data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = PerpanjanganSertifikatSOU::findOrFail($id);
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
        $fileFields = ['foto', 'scan_foto_npwp','scan_foto_ijazah','scan_foto_sertifikat'];

        foreach ($fileFields as $fieldName) {
            if ($data->$fieldName) {
                Storage::delete('public/img/' . basename($data->$fieldName));
            }
        }
    }
}
