<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiDetailController extends Controller
{
    public function index()
    {
        $transaksidetail = TransaksiDetail::with('transaksi')->orderBy('id', 'DESC')->get();

        return view('transaksidetail.index', compact('transaksidetail'));
    }

    public function detail($id_transaksi)
    {
        $transaksi = Transaksi::with('transaksidetail')->findOrFail($id_transaksi);

        return view('transaksidetail.detail', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksidetail = TransaksiDetail::findOrFail($id);

        return view('transaksidetail.edit', compact('transaksidetail'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'harga_satuan' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            // Update detail transaksi
            $transaksidetail = TransaksiDetail::findOrFail($id);
            $transaksidetail->nama_produk = $request->input('nama_produk');
            $transaksidetail->harga_satuan = $request->input('harga_satuan');
            $transaksidetail->jumlah = $request->input('jumlah');
            $transaksidetail->subtotal = $request->input('harga_satuan') * $request->input('jumlah');
            $transaksidetail->save();

            // Update total harga dan kembalian transaksi
            $transaksi = Transaksi::findOrFail($transaksidetail->id_transaksi);
            $total_harga = $transaksi->transaksidetail->sum('subtotal');
            $transaksi->total_harga = $total_harga;
            $transaksi->kembalian = $transaksi->bayar - $total_harga;
            $transaksi->save();

            DB::commit();

            return redirect('transaksidetail/' . $transaksidetail->id_transaksi)
                ->with('pesan', 'Berhasil mengubah data');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors(['Transaction' => 'Gagal mengubah data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            // Hapus detail transaksi
            $transaksidetail = TransaksiDetail::findOrFail($id);
            $id_transaksi = $transaksidetail->id_transaksi;
            $transaksidetail->delete();

            // Update total harga dan kembalian transaksi
            $transaksi = Transaksi::findOrFail($id_transaksi);
            $total_harga = $transaksi->transaksidetail->sum('subtotal');
            $transaksi->total_harga = $total_harga;
            $transaksi->kembalian = $transaksi->bayar - $total_harga;
            $transaksi->save();

            DB::commit();

            return redirect('transaksidetail/' . $id_transaksi)
                ->with('pesan', 'Berhasil menghapus data');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors(['Transaction' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }
}
