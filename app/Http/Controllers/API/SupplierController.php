<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;
use Validator;

class SupplierController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    public function index(){
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_supplier' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required'
        ]);
        if ($validate->passes()){

            $suppliers = Supplier::create($request->all());
            return response()->json([
                'message' => 'Data Berhasil Disimpan',
                'data' => $suppliers
            ]);
        }
        return response()->json([
            'message' => 'Data Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
    public function show($suppliers)
    {
        $data = Supplier::where('id_supplier', $suppliers)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
     public function update(Request $request, $suppliers)
    {
        $data = Supplier::where('id_supplier', $suppliers)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'nama_supplier' => 'required',
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
    public function destroy($suppliers)
    {
        $data = Supplier::where('id_supplier', $suppliers)->first();
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
