<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Satuan;
use App\Models\User;
use DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::all();
        return view('report.index',compact('barang'));
    }

    public function filter(Request $request){

        $from = $request->from;
        $id_barang = $request->id_barang;
        $filter = $request->filter;
        $to = $request->to;
        $manager = User::where("role",'manager')->first();
        $no_manager = $manager->no_telp;
        if($from > $to){
            return redirect()->route('report')->with('error', "Tanggal Awal tidak boleh lebih dari tanggal akhir");
        }

        $raw = "
            SELECT barang.id as barang_id,barang.nama_konversi,satuan.name as name_satuan,
            barang.nama_barang, transaksi_barang.jenis,SUM(transaksi_barang.qty) as jumlah
            FROM barang
            LEFT JOIN transaksi_barang on barang.id = transaksi_barang.id_barang
            LEFT JOIN satuan on barang.id_satuan = satuan.id
            WHERE barang.id = '$id_barang'
        " ; 

        if($filter == "barang_masuk"){
            $raw = $raw . " AND transaksi_barang.jenis = 'masuk' ";
        }else if($filter == "barang_keluar"){
            $raw = $raw . " AND transaksi_barang.jenis = 'keluar' ";
        }

        $raw  = $raw . "AND transaksi_barang.tanggal_transaksi BETWEEN '$from' AND '$to' 
        GROUP BY transaksi_barang.jenis,barang.id,barang.nama_barang,barang.nama_konversi,satuan.name
        ";

        $data = DB::select($raw);

        $raw2 = "
            SELECT barang.id as barang_id,barang.nama_konversi,satuan.name as name_satuan,
            transaksi_barang.tanggal_transaksi,
            barang.nama_barang, transaksi_barang.jenis
            FROM barang
            LEFT JOIN transaksi_barang on barang.id = transaksi_barang.id_barang
            LEFT JOIN satuan on barang.id_satuan = satuan.id
            WHERE barang.id = '$id_barang'
        " ; 

        if($filter == "barang_masuk"){
            $raw2 = $raw2 . " AND transaksi_barang.jenis = 'masuk' ";
        }else if($filter == "barang_keluar"){
            $raw2 = $raw2 . " AND transaksi_barang.jenis = 'keluar' ";
        }

        $raw2  = $raw2 . "AND transaksi_barang.tanggal_transaksi BETWEEN '$from' AND '$to' 
        ";

        $data2 = DB::select($raw2);
        $periode = $from . " - " . $to;
        return view('report.report_data',compact('data','data2','periode','no_manager'));

        
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
