<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::orderBy('username', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            return view('auth.button')->with('data', $data);
        })
        ->make(true);
    }

    public function showTotalPegawai()
    {
        $totalPegawai = DB::table('pegawai')->count();
        return view('admin.home', compact('totalPegawai'));
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
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ],[
            'username.required' => 'Nama Lengkap Wajib Di Isi',
            'nip.required' => 'NIP Wajib Di Isi',
            'email.email' => 'Format Email Harus Benar',
            'email.required' => 'Email Wajib Di Isi',
            'role.required' => 'Role Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi ->errors()]);
        }else{
            $data =  [
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'email' => $request->email,
            ];
            User::create($data);
            return response()->json(['success' => "Berhasil Menyimpan Data" ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::where('id', $id)->first();
        return response()->json(['result'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::where('id', $id)->first();
        return response()->json(['result'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ],[
            'username.required' => 'Nama Lengkap Wajib Di Isi',
            'nip.required' => 'NIP Wajib Di Isi',
            'email.email' => 'Format Email Harus Benar',
            'email.required' => 'Email Wajib Di Isi',
            'role.required' => 'Role Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi ->errors()]);
        }else{
            $data =  [
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'email' => $request->email,
            ];
            User::where('id' , $id)->update($data);
            return response()->json(['success' => "Berhasil Menyimpan Data" ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
    }
}
