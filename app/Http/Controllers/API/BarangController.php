<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Barang;
use Validator;

class BarangController extends Controller
{

    public function __construct()
    {
         $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index(){
        // $barangs = Barang::all();
        $barangs = Barang::with('Supplier')->get();
        return response()->json($barangs);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'namabarang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'id_supplier' => 'required'
        ]);
        if ($validate->passes()){

            $barangs = Barang::create($request->all());
            return response()->json([
                'message' => 'Data Berhasil Disimpan',
                'data' => $barangs
            ]);
        }
        return response()->json([
            'message' => 'Data Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
    public function show($barangs)
    {
        $data = Barang::where('id_barang', $barangs)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
     public function update(Request $request, $barangs)
    {
        $data = Barang::where('id_barang', $barangs)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'namabarang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'id_supplier' => 'required'
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
    public function destroy($barangs)
    {
        $data = Barang::where('id_barang', $barangs)->first();
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
