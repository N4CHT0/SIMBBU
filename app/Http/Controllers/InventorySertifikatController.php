<?php

namespace App\Http\Controllers;

use App\Models\InventorySertifikat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class InventorySertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = InventorySertifikat::orderBy('nama_pemilik', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            return view('inventory_sertifikat.button',compact('data'));
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
            'nama_pemilik' => 'required',
            'email' => 'required|email|unique:inventory_sertifikat,email,' . $request->id,
            'no_sertifikat' => 'required',
            'status_sertifikat' => 'required',
            'jenis_sertifikat' => 'required',
            'foto_sertifikat' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
        ], [
            'nama_pemilik.required' => 'Nama Lengkap Wajib Di Isi',
            'email.email' => 'Format Email Harus Benar',
            'email.required' => 'Email Wajib Di Isi',
            'status_sertifikat.required' => 'Status Sertifikat Wajib Di Isi',
            'jenis_sertifikat.required' => 'Jenis Sertifikat Wajib Di Isi',
            'no_sertifikat.required' => 'Nomor Sertifikat Wajib Di Isi',
            'foto_sertifikat.required' => 'Foto Sertifikat Wajib Diupload',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        $data = [
            'nama_pemilik' => $request->nama_pemilik,
            'no_sertifikat' => $request->no_sertifikat,
            'email' => $request->email,
            'status_sertifikat' => $request->status_sertifikat,
            'jenis_sertifikat' => $request->jenis_sertifikat,
        ];

        // Simpan file foto jika ada
        $this->processImageUpload($request, 'foto_sertifikat', $data);
        $this->processImageUpload($request, 'bukti_pengambilan', $data);
        $this->processImageUpload($request, 'bukti_pengiriman', $data);

        InventorySertifikat::create($data);
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
        $data = InventorySertifikat::where('id', $id)->first();
        return response()->json(['result'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = InventorySertifikat::where('id', $id)->first();
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
            $model = InventorySertifikat::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['errors' => ['Data tidak ditemukan']], 404);
        }

        // Validasi data seperti pada fungsi update
        $validasi = Validator::make($request->all(), [
            'jenis_sertifikat' => 'required',
            'status_sertifikat' => 'required',
            'no_sertifikat' => 'required',
            'nama_pemilik' => 'required',
            'foto_sertifikat' => $request->hasFile('foto_sertifikat') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'bukti_pengambilan' => $request->hasFile('bukti_pengambilan') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
            'bukti_pengiriman' => $request->hasFile('bukti_pengiriman') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
        ], [
            'nama_pemilik.required' => 'Nama Pemilik Wajib Di Isi',
            'jenis_sertifikat.required' => 'Jenis Sertifikat Wajib Di Isi',
            'no_sertifikat.required' => 'Nomor Sertifikat Wajib Di Isi',
            'status_sertifikat.required' => 'Status Sertifikat Wajib Di Isi',
            'foto_sertifikat.required' => 'Foto Sertifikat Wajib Diupload',
            'bukti_pengambilan.required' => 'Bukti Pengambilan Wajib Diupload',
            'bukti_pengiriman.required' => 'Bukti Pengiriman Wajib Diupload',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        // Inisialisasi $data
        $data = [];
        // Simpan file foto jika ada
        $this->processImageUpload($request, 'foto_sertifikat', $data, $model);
        $this->processImageUpload($request, 'bukti_pengambilan', $data, $model);
        $this->processImageUpload($request, 'bukti_pengiriman', $data, $model);


        // Update data
        $model->update([
            'nama_pemilik' => $request->nama_pemilik,
            'jenis_sertifikat' => $request->jenis_sertifikat,
            'no_sertifikat' => $request->no_sertifikat,
            'status_sertifikat' => $request->status_sertifikat,
            'email' => $request->email,
            'foto_sertifikat' => $data['foto_sertifikat'] ?? $model->foto, // Pastikan atribut sesuai dengan kolom di tabel
            'bukti_pengambilan' => $data['bukti_pengambilan'] ?? $model->bukti_pengambilan,
            'bukti_pengiriman' => $data['bukti_pengiriman'] ?? $model->bukti_pengiriman,
            ]);

        return response()->json(['success' => 'Berhasil Melakukan Update Data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = InventorySertifikat::findOrFail($id);
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
        $fileFields = ['foto_sertifikat', 'bukti_pengambilan', 'bukti_pengiriman'];

        foreach ($fileFields as $fieldName) {
            if ($data->$fieldName) {
                Storage::delete('public/img/' . basename($data->$fieldName));
            }
        }
    }
}
