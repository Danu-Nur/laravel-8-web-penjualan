<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Models\Produk;
use Exception;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produk::all();

        // $mix = Produk::kategori_produks();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $req = $request->validate([
                'id_user' => 'required',
                'id_kategori' => 'required',
                'produk' => 'required',
                'harga' => 'required',
                'foto' => 'required|file|mimes:png,jpg',
                'keterangan' => 'required',
            ]);

            $fileName = time() . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('uploads/fotoproduk', $fileName);
            $req['foto'] = $fileName;

            $produk = Produk::create($req);

            $data = Produk::where('id', '=', $produk->id)->get();

            if ($data) {
                return ApiFormatter::createApi(200, 'Success', $data);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Produk::find(5);

        // $produk = $data->kategori_produks;

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $req = $request->validate([
                'id_user' => 'required',
                'id_kategori' => 'required',
                'produk' => 'required',
                'harga' => 'required',
                'foto' => 'required|file|mimes:png,jpg',
                'keterangan' => 'required',
            ]);

            $fileName = time() . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('uploads/fotoproduk', $fileName);
            $req['foto'] = $fileName;

            $produk = Produk::findOrFail($id);

            $produk->update($req);

            $data = Produk::where('id', '=', $produk->id)->get();

            if ($data) {
                return ApiFormatter::createApi(200, 'Success', $data);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);

            $data = $produk->delete();

            if ($data) {
                return ApiFormatter::createApi(200, 'Success Destory data');
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, $error->getMessage());
        }
    }
}
