<?php

namespace App\Http\Controllers;

use App\Models\SertifikatMCU;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class SertifikatMCUController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SertifikatMCU::orderBy('nama_lengkap', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            return view('sertifikat_mcu.button',compact('data'));
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
            'jabatan_diatas_kapal' => 'required',
            'foto' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
            'foto_ktp' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
            'foto_bst' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
        ], [
            'nama_lengkap.required' => 'Nama Lengkap Wajib Di Isi',
            'jabatan_diatas_kapal.required' => 'Jabatan Diatas Kapal Wajib Di Isi',
            'foto.required' => 'Foto Wajib Diupload',
            'foto_ktp.required' => 'Foto KTP Wajib Diupload',
            'foto_bst.required' => 'Foto BST Wajib Diupload',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'jabatan_diatas_kapal' => $request->jabatan_diatas_kapal,
        ];

        // Simpan file foto jika ada
        $this->processImageUpload($request, 'foto', $data);
        $this->processImageUpload($request, 'foto_ktp', $data);
        $this->processImageUpload($request, 'foto_bst', $data);

        SertifikatMCU::create($data);
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
        $data = SertifikatMCU::where('id', $id)->first();
        return response()->json(['result'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = SertifikatMCU::where('id', $id)->first();
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
            $model = SertifikatMCU::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['errors' => ['Data tidak ditemukan']], 404);
        }

        // Validasi data seperti pada fungsi update
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'jabatan_diatas_kapal' => 'required',
            'foto' => $request->hasFile('foto') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'foto_ktp' => $request->hasFile('foto_ktp') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'foto_bst' => $request->hasFile('foto_bst') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
        ], [
            'nama_lengkap.required' => 'Nama Lengkap Wajib Di Isi',
            'jabatan_diatas_kapal.required' => 'Jabatan Diatas Kapal Wajib Di Isi',
            'foto.required' => 'Foto Wajib Diupload',
            'foto_ktp.required' => 'Foto KTP Wajib Diupload',
            'foto_bst.required' => 'Foto BST Wajib Diupload',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        // Inisialisasi $data
        $data = [];
        // Simpan file foto jika ada
        $this->processImageUpload($request, 'foto', $data, $model);
        $this->processImageUpload($request, 'foto_ktp', $data, $model);
        $this->processImageUpload($request, 'foto_bst', $data, $model);


        // Update data
        $model->update([
            'nama_lengkap' => $request->nama_lengkap,
            'jabatan_diatas_kapal' => $request->jabatan_diatas_kapal,
            'foto' => $data['foto'] ?? $model->foto, // Pastikan atribut sesuai dengan kolom di tabel
            'foto_ktp' => $data['foto_ktp'] ?? $model->foto_ktp,
            'foto_bst' => $data['foto_bst'] ?? $model->foto_bst,
            ]);

        return response()->json(['success' => 'Berhasil Melakukan Update Data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = SertifikatMCU::findOrFail($id);
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
        $fileFields = ['foto', 'foto_ktp','foto_bst'];

        foreach ($fileFields as $fieldName) {
            if ($data->$fieldName) {
                Storage::delete('public/img/' . basename($data->$fieldName));
            }
        }
    }
}
