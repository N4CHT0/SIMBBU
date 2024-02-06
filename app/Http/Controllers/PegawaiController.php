<?php

namespace App\Http\Controllers;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pegawai::orderBy('nama_lengkap', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            return view('pegawai.button')->with('data', $data);
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
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'email' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
            'no_telp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nip' => 'required',
        ],[
            'nama_lengkap.required' => 'Nama Lengkap Wajib Di Isi',
            'nip.required' => 'NIP Wajib Di Isi',
            'email.email' => 'Format Email Harus Benar',
            'email.required' => 'Email Wajib Di Isi',
            'tempat_lahir.required' => 'Tempat Lahir Wajib Di Isi',
            'no_telp.required' => 'Nomor Telepon Wajib Di Isi',
            'tanggal_lahir.required' => 'Tanggal Lahir Wajib Di Isi',
            'divisi.required' => 'Divisi Wajib Di Isi',
            'jabatan.required' => 'Jabatan Wajib Di Isi',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi ->errors()]);
        }else{
            $data =  [
                'nama_lengkap' => $request->nama_lengkap,
                'jabatan' => $request->jabatan,
                'divisi' => $request->divisi,
                'no_telp' => $request->no_telp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'email' => $request->email,
                'nip' => $request->nip,
            ];
            Pegawai::create($data);
            return response()->json(['success' => "Berhasil Menyimpan Data" ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Pegawai::where('id', $id)->first();
        return response()->json(['result'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Pegawai::where('id', $id)->first();
        return response()->json(['result'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'email' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
            'no_telp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nip' => 'required',
        ],[
            'nama_lengkap.required' => 'Nama Lengkap Wajib Di Isi',
            'nip.required' => 'NIP Wajib Di Isi',
            'email.email' => 'Format Email Harus Benar',
            'email.required' => 'Email Wajib Di Isi',
            'tempat_lahir.required' => 'Tempat Lahir Wajib Di Isi',
            'no_telpon.required' => 'Nomor Telepon Wajib Di Isi',
            'tanggal_lahir.required' => 'Tanggal Lahir Wajib Di Isi',
            'divisi.required' => 'Divisi Wajib Di Isi',
            'jabatan.required' => 'Jabatan Wajib Di Isi',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi ->errors()]);
        }else{
            $data =  [
                'nama_lengkap' => $request->nama_lengkap,
                'jabatan' => $request->jabatan,
                'divisi' => $request->divisi,
                'no_telp' => $request->no_telp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'email' => $request->email,
                'nip' => $request->nip,
            ];
            Pegawai::where('id' , $id)->update($data);
            return response()->json(['success' => "Berhasil Melakukan Update Data" ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pegawai::where('id', $id)->delete();
    }
}
