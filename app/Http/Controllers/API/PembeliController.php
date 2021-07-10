<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pembeli;
use Validator;

class PembeliController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index(){
        $pembelis = Pembeli::all();
        return response()->json($pembelis);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_pembeli' => 'required',
            'jk' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required'
        ]);
        if ($validate->passes()){

            $pembelis = Pembeli::create($request->all());
            return response()->json([
                'message' => 'Data Berhasil Disimpan',
                'data' => $pembelis
            ]);
        }
        return response()->json([
            'message' => 'Data Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
    public function show($pembelis)
    {
        $data = Pembeli::where('id_pembeli', $pembelis)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
     public function update(Request $request, $pembelis)
    {
        $data = Pembeli::where('id_pembeli', $pembelis)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'nama_pembeli' => 'required',
            'jk' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required'
        ]);
            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Berhasil Disimpan',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data Gagal Disimpan',
                    'data' => $validate->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data tidak ditemukan'
        ], 404);
    }
    public function destroy($pembelis)
    {
        $data = Pembeli::where('id_pembeli', $pembelis)->first();
        if (empty($data)) {
            return response()->json([
                'message' => 'Data Tidak Ditemukan'
            ], 404);
            # code...
        }
        
        $data->delete();
        return response()->json([
            'message' => 'Data Berhasil Dihapus'
        ], 200);
    }
}
