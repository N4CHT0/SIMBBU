<?php

namespace App\Http\Controllers;

use App\Models\NilaiUjianLokal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class NilaiUjianLokalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = NilaiUjianLokal::orderBy('id_user', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            return view('nilai_ujian_lokal.button',compact('data'));
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
            'nilai_teknik_radio' => 'required',
            'nilai_naveka' => 'required',
            'nilai_service_document' => 'required',
            'nilai_pengaturan_radio' => 'required',
            'nilai_bahasa_inggris' => 'required',
            'nilai_perjanjian_internasional' => 'required',
            'nilai_gmdss' => 'required',
            'nilai_telephony' => 'required',
            'nilai_ibt' => 'required',
            'nilai_morse' => 'required',
            'nilai_pancasila' => 'required',
            'nilai_teknik_listrik' => 'required',
            'nilai_praktek_service_document' => 'required',
            'nilai_praktek_telephony' => 'required',
            'nilai_praktek_morse' => 'required',
            'nilai_praktek_gmdss' => 'required',
        ], [
            'nilai_teknik_radio' => 'Nilai Teknik Radio Wajib Di Isi',
            'nilai_service_document' => 'Nilai Service Document Wajib Di Isi',
            'nilai_naveka' => 'Nilai Naveka Wajib Di Isi',
            'nilai_pengaturan_radio' => 'Nilai Pengaturan Radio Wajib Di Isi',
            'nilai_bahasa_inggris' => 'Nilai Bahasa Inggris Wajib Di Isi',
            'nilai_perjanjian_internasional' => 'Nilai Perjanjian Internasional Wajib Di Isi',
            'nilai_gmdss' => 'Nilai GMDSS Wajib Di Isi',
            'nilai_telephony' => 'Nilai Telephony Wajib Di Isi',
            'nilai_ibt' => 'Nilai IBT Wajib Di Isi',
            'nilai_morse' => 'Nilai Morse Wajib Di Isi',
            'nilai_pancasila' => 'Nilai Pancasila Wajib Di Isi',
            'nilai_teknik_listrik' => 'Nilai Teknik Listrik Wajib Di Isi',
            'nilai_praktek_service_document' => 'Nilai Praktek Service Document Wajib Di Isi',
            'nilai_praktek_telephony' => 'Nilai Praktek Telephony Wajib Di Isi',
            'nilai_praktek_morse' => 'Nilai Praktek Morse Wajib Di Isi',
            'nilai_praktek_gmdss' => 'Nilai Praktek GMDSS Wajib Di Isi',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        $data = [
            'nilai_teknik_listrik' => $request->nilai_teknik_listrik,
            'nilai_teknik_radio' => $request->nilai_teknik_radio,
            'nilai_naveka' => $request->nilai_naveka,
            'nilai_service_document' => $request->nilai_service_document,
            'nilai_pengaturan_radio' => $request->nilai_pengaturan_radio,
            'nilai_perjanjian_internasional' => $request->nilai_perjanjian_internasional,
            'nilai_bahasa_inggris' => $request->nilai_bahasa_inggris,
            'nilai_gmdss' => $request->nilai_gmdss,
            'nilai_telephony' => $request->nilai_telephony,
            'nilai_ibt' => $request->nilai_ibt,
            'nilai_morse' => $request->nilai_morse,
            'nilai_pancasila' => $request->nilai_pancasila,
            'nilai_praktek_service_document' => $request->nilai_praktek_service_document,
            'nilai_praktek_telephony' => $request->nilai_praktek_telephony,
            'nilai_praktek_morse' => $request->nilai_praktek_morse,
            'nilai_praktek_gmdss' => $request->nilai_praktek_gmdss,
        ];

        NilaiUjianLokal::create($data);
        return response()->json(['success' => "Berhasil Menyimpan Data"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = NilaiUjianLokal::where('id', $id)->first();
        return response()->json(['result'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = NilaiUjianLokal::where('id', $id)->first();
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
            $model = NilaiUjianLokal::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['errors' => ['Data tidak ditemukan']], 404);
        }

        // Validasi data seperti pada fungsi update
        $validasi = validator::make($request->all(), [
            'nilai_teknik_radio' => 'required',
            'nilai_service_document' => 'required',
            'nilai_pengaturan_radio' => 'required',
            'nilai_bahasa_inggris' => 'required',
            'nilai_naveka' => 'required',
            'nilai_perjanjian_internasional' => 'required',
            'nilai_gmdss' => 'required',
            'nilai_telephony' => 'required',
            'nilai_ibt' => 'required',
            'nilai_morse' => 'required',
            'nilai_pancasila' => 'required',
            'nilai_teknik_listrik' => 'required',
            'nilai_praktek_service_document' => 'required',
            'nilai_praktek_telephony' => 'required',
            'nilai_praktek_morse' => 'required',
            'nilai_praktek_gmdss' => 'required',
        ], [
            'nilai_teknik_radio' => 'Nilai Teknik Radio Wajib Di Isi',
            'nilai_naveka' => 'Nilai Naveka Wajib Di Isi',
            'nilai_service_document' => 'Nilai Service Document Wajib Di Isi',
            'nilai_pengaturan_radio' => 'Nilai Pengaturan Radio Wajib Di Isi',
            'nilai_bahasa_inggris' => 'Nilai Bahasa Inggris Wajib Di Isi',
            'nilai_perjanjian_internasional' => 'Nilai Perjanjian Internasional Wajib Di Isi',
            'nilai_gmdss' => 'Nilai GMDSS Wajib Di Isi',
            'nilai_telephony' => 'Nilai Telephony Wajib Di Isi',
            'nilai_ibt' => 'Nilai IBT Wajib Di Isi',
            'nilai_morse' => 'Nilai Morse Wajib Di Isi',
            'nilai_pancasila' => 'Nilai Pancasila Wajib Di Isi',
            'nilai_teknik_listrik' => 'Nilai Teknik Listrik Wajib Di Isi',
            'nilai_praktek_service_document' => 'Nilai Praktek Service Document Wajib Di Isi',
            'nilai_praktek_telephony' => 'Nilai Praktek Telephony Wajib Di Isi',
            'nilai_praktek_morse' => 'Nilai Praktek Morse Wajib Di Isi',
            'nilai_praktek_gmdss' => 'Nilai Praktek GMDSS Wajib Di Isi',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 422);
        }

        // Update data
        $model->update([
            'nilai_teknik_listrik' => $request->nilai_teknik_listrik,
            'nilai_naveka' => $request->nilai_naveka,
            'nilai_teknik_radio' => $request->nilai_teknik_radio,
            'nilai_bahasa_inggris' => $request->nilai_bahasa_inggris,
            'nilai_service_document' => $request->nilai_service_document,
            'nilai_pengaturan_radio' => $request->nilai_pengaturan_radio,
            'nilai_perjanjian_internasional' => $request->nilai_perjanjian_internasional,
            'nilai_gmdss' => $request->nilai_gmdss,
            'nilai_telephony' => $request->nilai_telephony,
            'nilai_ibt' => $request->nilai_ibt,
            'nilai_morse' => $request->nilai_morse,
            'nilai_pancasila' => $request->nilai_pancasila,
            'nilai_praktek_service_document' => $request->nilai_praktek_service_document,
            'nilai_praktek_telephony' => $request->nilai_praktek_telephony,
            'nilai_praktek_morse' => $request->nilai_praktek_morse,
            'nilai_praktek_gmdss' => $request->nilai_praktek_gmdss,
            ]);

        return response()->json(['success' => 'Berhasil Melakukan Update Data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = NilaiUjianLokal::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }

        // Hapus data dari basis data
        $data->delete();

        return response()->json(['success' => 'Berhasil menghapus data.']);
    }
}
