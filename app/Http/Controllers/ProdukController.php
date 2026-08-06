<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller

{
    public function index(SearchRequest $request)
{
    $this->authorize('viewAny', Produk::class);

    $keyword = $request->input('search');

    if($keyword) {
    $products = Produk::when($keyword, function ($query) use ($keyword) {
        $query->where('nama', 'like', '%' . $keyword . '%');
    })
    ->orderBy('nama')
    ->paginate(10)
    ->withQueryString();
} else {
    $products = Produk::latest()->paginate(10)->withQueryString();
}
    return view('produk.index', compact('products'));
    }
    public function create()
    {
        $this->authorize('create', Produk::class);

        return view('produk.create');
    }

    public function store(StoreRequest $request)
{
    $this->authorize('create', Produk::class);

    $dataReq = $request->validated();
    
    $data['user_id'] = Auth::id();
    $data['nama'] = $dataReq['name'];
    $data['harga_beli'] = $dataReq['purchase_price'];
    $data['harga_jual'] = $dataReq['selling_price'];
    $data['stok'] = $dataReq['stok'] ?? true;
    
    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('produk', 'public');
}

    Produk::create($data);

    return redirect()->route('produk.index')->with('succes', 'product created successfully');
    }
        public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);

        return view('produk.edit', compact('produk'));
    }

    public function update(UpdateRequest $request, Produk $produk)
{
    $this->authorize('update', $produk);

    $dataReq = $request->validated();

    $data = [
        'user_id'    => Auth::id(),
        'nama'       => $dataReq['name'],
        'harga_beli' => $dataReq['purchase_price'],
        'harga_jual' => $dataReq['selling_price'],
        'stok'       => $dataReq['stok'],
    ];

    
    if ($request->hasFile('foto')) {
        
        
        if (
            $produk->foto && 
            Storage::disk('public')->exists($produk->foto)
        ) {
            Storage::disk('public')->delete($produk->foto);
        }

        
        $data['foto'] = $request->file('foto')->store('products', 'public');
    }

    $produk->update($data);

    return redirect()->route('produk.index')->with('success', 'Product updated successfully');
}
    public function destroy(Produk $produk)
{
    $this->authorize('delete', $produk);

    try {
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }
        
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Product deleted successfully.');

    } catch (\Throwable $e) {
        return redirect()->route('produk.index')
            ->with('error', 'Gagal menghapus! Produk ini sudah terikat dengan transaksi penjualan.');
    }
}
}
