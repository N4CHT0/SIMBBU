<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Keuangan::orderBy('status_pembayaran', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            return view('keuangan.button',compact('data'));
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
            'jenis_diklat' => 'required',
            'status_pembayaran' => 'required',
            'bukti_pembayaran' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080',
        ], [
            'jenis_diklat.required' => 'Jenis Diklat Wajib Di Isi',
            'status_pembayaran.required' => 'Status Pembayaran Wajib Di Isi',
            'bukti_pembayaran.required' => 'Bukti Pembayaran Wajib Diupload',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        $data = [
            'jenis_diklat' => $request->jenis_diklat,
            'status_pembayaran' => $request->status_pembayaran,
        ];

        // Simpan file foto jika ada
        $this->processImageUpload($request, 'bukti_pembayaran', $data);

        Keuangan::create($data);
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
        $data = Keuangan::where('id', $id)->first();
        return response()->json(['result'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Keuangan::where('id', $id)->first();
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
            $model = Keuangan::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['errors' => ['Data tidak ditemukan']], 404);
        }

        // Validasi data seperti pada fungsi update
        $validasi = Validator::make($request->all(), [
            'jenis_diklat' => 'required',
            'status_pembayaran' => 'required',
            'bukti_pembayaran' => $request->hasFile('bukti_pembayaran') ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:7080' : '',
        ], [
            'jenis_diklat.required' => 'Jenis Diklat Wajib Di Isi',
            'status_pembayaran.required' => 'status_pembayaran Wajib Di Isi',
            'bukti_pembayaran.required' => 'Bukti Pembayaran Wajib Diupload',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        // Inisialisasi $data
        $data = [];
        // Simpan file foto jika ada
        $this->processImageUpload($request, 'bukti_pembayaran', $data, $model);


        // Update data
        $model->update([
            'jenis_diklat' => $request->jenis_diklat,
            'status_pembayaran' => $request->status_pembayaran,
            'bukti_pembayaran' => $data['bukti_pembayaran'] ?? $model->bukti_pembayaran, // Pastikan atribut sesuai dengan kolom di tabel
            ]);

        return response()->json(['success' => 'Berhasil Melakukan Update Data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Keuangan::findOrFail($id);
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
        $fileFields = ['bukti_pembayaran'];

        foreach ($fileFields as $fieldName) {
            if ($data->$fieldName) {
                Storage::delete('public/img/' . basename($data->$fieldName));
            }
        }
    }
}
