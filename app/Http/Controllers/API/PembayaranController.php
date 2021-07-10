<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pembayaran;
use Validator;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index(){
        $pembayarans = Pembayaran::with('Transaksi')->get();
        return response()->json($pembayarans);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'tgl_bayar' => 'required',
            'total_bayar' => 'required',
            'id_transaksi' => 'required'
        ]);
        if ($validate->passes()){

            $pembayarans = Pembayaran::create($request->all());
            return response()->json([
                'message' => 'Data Berhasil Disimpan',
                'data' => $pembayarans
            ]);
        }
        return response()->json([
            'message' => 'Data Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
    public function show($pembayarans)
    {
        $data = Pembayaran::where('id_pembayaran', $pembayarans)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
     public function update(Request $request, $pembayarans)
    {
        $data = Pembayaran::where('id_pembayaran', $pembayarans)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'tgl_bayar' => 'required',
            'total_bayar' => 'required',
            'id_transaksi' => 'required'
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
    public function destroy($pembayarans)
    {
        $data = Pembayaran::where('id_pembayaran', $pembayarans)->first();
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
