@extends('layout')
@section('content')
    <h1 class="heading-title">Tambah Produk</h1>

    <form action="{{ route('products_create') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf
        <div class="form-group">
            <label for="img" class="form-label">Foto Produk</label>
            <input type="file" id="img" name="img" class="form-input-file">
        </div>
        <div class="form-group">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" id="name" name="name" class="form-input">
        </div>
        <div class="form-group">
            <label for="description" class="form-label">Deskripsi Produk</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-input"></textarea>
        </div>
        <div class="form-group">
            <label for="price" class="form-label">Harga Produk</label>
            <input type="number" id="price" name="price" class="form-input">
        </div>
        </div>
        <select class="form-select @error('category_id') is-invalid @enderror" aria-label="Default select example"
            name="category_id">
            <option selected>Pilih Kategori Produk</option>
            @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->id }} - {{ $item->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">
                Pilih Salah Satu Kategori
            </div>
        @enderror
        <div class="form-group-button">
            <button type="submit" class="form-button">Add Produk</button>
        </div>
    </form>
@endsection