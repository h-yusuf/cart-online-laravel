<?php

namespace App\Http\Controllers;

use App\Models\Produkmodel;
use Illuminate\Http\Request;

class Produk extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('produk/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('produk/form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produk,kode_produk',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'stok_produk' => 'required|min:1|numeric',
            'harga_jual' => 'required|min:1000|numeric'
        ]);

        $produk = new Produkmodel([
            'kode_produk' => $request->get('kode_produk'),
            'nama_produk' => $request->get('nama_produk'),
            'deskripsi' => $request->get('deskripsi'),
            'stok' => $request->get('stok_produk'),
            'harga' => $request->get('harga_jual'),
            'foto_produk' => '',
        ]);

        $saved = $produk->save();

        if(!$saved){
            $data_json = [
                'pesan' => 'Gagal Menambah Data',
                'produk' => $produk,
            ];
        } else {
            $data_json = [
                'pesan' => 'Sukses',
                'produk' => $produk,
            ];
        }

        return json_encode($data_json);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produkmodel  $produkmodel
     * @return \Illuminate\Http\Response
     */
    public function show(Produkmodel $produkmodel, $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produkmodel  $produkmodel
     * @return \Illuminate\Http\Response
     */
    public function edit(Produkmodel $produkmodel, $id)
    {
        //
        $data_detail = $produkmodel::where('id_produk', $id)->first();

        $data = [
            'data_view' => $data_detail,
        ];

        return view('produk/formUbah', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produkmodel  $produkmodel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produkmodel $produkmodel)
    {
        //
        $id = $request->get('id_produk');

        $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'stok_produk' => 'required|min:1|numeric',
            'harga_jual' => 'required|min:1000|numeric'
        ]);

        $produk = new Produkmodel([
            'kode_produk' => $request->get('kode_produk'),
            'nama_produk' => $request->get('nama_produk'),
            'deskripsi' => $request->get('deskripsi'),
            'stok' => $request->get('stok_produk'),
            'harga' => $request->get('harga_jual'),
            'foto_produk' => '',
        ]);

        $data_db = Produkmodel::find($id);

        if ($data_db != null) {
            $data_db->kode_produk = $request->get('kode_produk');
            $data_db->nama_produk = $request->get('nama_produk');
            $data_db->deskripsi = $request->get('deskripsi');
            $data_db->stok = $request->get('stok_produk');
            $data_db->harga = $request->get('harga_jual');
            $saved = $data_db->save();

            if(!$saved){
                $data_json = [
                    'pesan' => 'Gagal Menambah Data',
                    'produk' => $data_db,
                ];
            } else {
                $data_json = [
                    'pesan' => 'Sukses',
                    'produk' => $data_db,
                ];
            }
        } else {
            $data_json = [
                'pesan' => 'Gagal',
            ];
        }

        return json_encode($data_json);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produkmodel  $produkmodel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produkmodel $produkmodel, Request $request)
    {
        $id = $request->get('id');

        $data_db = Produkmodel::find($id);

        if ($data_db != null) {
            $data_db->delete();
        }

        $data_json = [
            'pesan' => 'Sukses Hapus Data',
            'data_delete' => $data_db,
        ];

        return json_encode($data_json);
    }

    public function getListProduk(Produkmodel $produkmodel)
    {
        $data = $produkmodel::all();

        return json_encode($data);
    }

    public function getByKode(Produkmodel $produkmodel, $kode)
    {
        $data = $produkmodel::where('kode_produk', 'LIKE', "%{$kode}%")->get();

        return json_encode($data);
    }
}
