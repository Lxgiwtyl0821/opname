<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Satuan;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::all();
        $satuan = Satuan::all();
        return view('barang.index',compact('barang','satuan'));
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
        $data = new Barang();
        $data->nama_barang = $request->nama_barang;
        $data->nama_konversi = $request->nama_konversi;
        if($file = $request->file('foto')){

                $nama_file = md5_file($file->getRealPath()) ."_".$file->getClientOriginalName();
                $path = 'file/barang';
                $file->move($path,$nama_file);
                $data->foto = $nama_file;
        }
        $data->stock = $request->stock;
        $data->id_satuan = $request->id_satuan;
        $data->save();
        return redirect()->route('barang')->with('success', "Data Barang Berhasil Ditambahkan !");
    }

    public function detail(Request $request){
        $data = Barang::where('id',$request->id)->with('satuan')->first();
        return response()->json([
            'data' => $data,
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = Barang::find($request->id);
        $data->nama_barang = $request->nama_barang;
        $data->nama_konversi = $request->nama_konversi;
        if($file = $request->file('foto')){

                $nama_file = md5_file($file->getRealPath()) ."_".$file->getClientOriginalName();
                $path = 'file/barang';
                $file->move($path,$nama_file);
                $data->foto = $nama_file;
        }
        $data->stock = $request->stock;
        $data->id_satuan = $request->id_satuan;
        $data->save();
        return redirect()->route('barang')->with('success', "Data Barang Berhasil Diupdate !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $barang = Barang::findOrFail($id);
            // unlink("file/barang/" . $barang->foto);
            $barang->delete();
            return redirect()->route('barang')->with('success', "Data barang Berhasil Di Hapus !");
        }catch(\Throwable $e){
            return redirect()->route('barang')->with('error', $e);
        }
    }
}
