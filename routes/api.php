<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('password',function (){
    return bcrypt('darmawan');
});

Route::get('/transaksi', 'API\TransaksiController@index');
Route::get('/transaksi/{transaksis}', 'API\TransaksiController@show');
Route::delete('/transaksi/{transaksis}', 'API\TransaksiController@destroy');
Route::post('/transaksi/', 'API\TransaksiController@store');
Route::patch('/transaksi/{transaksis}', 'API\TransaksiController@update');

Route::get('/barang', 'API\BarangController@index');
Route::get('/barang/{barangs}', 'API\BarangController@show');
Route::delete('/barang/{barangs}', 'API\BarangController@destroy');
Route::post('/barang/', 'API\BarangController@store');
Route::patch('/barang/{barangs}', 'API\BarangController@update');

Route::get('/supplier', 'API\SupplierController@index');
Route::get('/supplier/{supplier}', 'API\SupplierController@show');
Route::delete('/supplier/{supplier}', 'API\SupplierController@destroy');
Route::post('/supplier/', 'API\SupplierController@store');
Route::patch('/supplier/{supplier}', 'API\SupplierController@update');

Route::get('/pembayaran', 'API\PembayaranController@index');
Route::get('/pembayaran/{pembayaran}', 'API\PembayaranController@show');
Route::delete('/pembayaran/{pembayaran}', 'API\PembayaranController@destroy');
Route::post('/pembayaran/', 'API\PembayaranController@store');
Route::patch('/pembayaran/{pembayaran}', 'API\PembayaranController@update');

Route::get('/pembeli', 'API\PembeliController@index');
Route::get('/pembeli/{pembeli}', 'API\PembeliController@show');
Route::delete('/pembeli/{pembeli}', 'API\PembeliController@destroy');
Route::post('/pembeli/', 'API\PembeliController@store');
Route::patch('/pembeli/{pembeli}', 'API\PembeliController@update');

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});