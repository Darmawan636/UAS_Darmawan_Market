<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi;
use Validator;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index(){
        $transaksis = Transaksi::with('Barang', 'Pembeli')->get();
        return response()->json($transaksis);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id_barang' => 'required',
            'id_pembeli' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required'
        ]);
        if ($validate->passes()){

            $transaksis = Transaksi::create($request->all());
            return response()->json([
                'message' => 'Data Berhasil Disimpan',
                'data' => $transaksis
            ]);
        }
        return response()->json([
            'message' => 'Data Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
    public function show($transaksis)
    {
        $data = Transaksi::where('id_transaksi', $transaksis)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
     public function update(Request $request, $transaksis)
    {
        $data = Transaksi::where('id_transaksi', $transaksis)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'id_barang' => 'required',
            'id_pembeli' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required'
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
    public function destroy($transaksis)
    {
        $data = Transaksi::where('id_transaksi', $transaksis)->first();
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
