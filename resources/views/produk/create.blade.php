@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

@include('layouts.navbar')

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-3">
        
        <div class="card-body bg-primary text-white rounded-4 p-4 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1">Tambah Produk</h3>
                <p class="mb-0 text-white-50 small">Isi formulir untuk menambahkan produk baru.</p>
            </div>
            <a href="{{ route('produk.index') }}" class="btn btn-light btn-sm fw-bold text-primary rounded-3 px-3">
                ← Kembali
            </a>
        </div>

        <div class="px-2">
            <form action="{{ route('produk.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="form-tambah-produk">
                
                @include('produk._form')
                
            </form>
        </div>

    </div>
</div>

@endsection