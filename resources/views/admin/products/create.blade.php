@extends('layouts.admin')
@section('title', 'Tambah Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0 text-gray-800">Tambah Produk Baru</h2>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Produk --}}
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-bold">Nama Produk</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Berat --}}
                        <div class="mb-3 col-md-6 ">
                            <Label class="form-label fw-bold">Berat (Gram)</Label>
                            <input type="text" name="weight" class="form-control @error('weight')
                            is-invalid
                        @enderror" value="{{ old('weight') }}">
                            @error('weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>


                    {{-- Kategori Dropdown --}}
                    <div class="row">
                        <div class="mb-3 col-md-12 ">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Pilih Kategori...</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' :
                                    '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>


                    </div>


                    {{-- Harga & Stok --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Stok</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
                        </div>
                    </div>

                    {{-- Gambar --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload Gambar</label>
                        <input type="file" name="images[]" multiple class="form-control">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">Simpan Produk</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<!--Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/2agkyohbxcuqd3rwf4vcdkrl0pg232mo8qps7ynzq7qdvty3/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    
    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
      tinymce.init({
        selector: 'textarea',
        plugins: [
          // Core editing features
          'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
          // Your account includes a free trial of TinyMCE premium features
          // Try the most popular premium features until Jan 5, 2026:
          'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'ai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
          { value: 'First.Name', title: 'First Name' },
          { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
        uploadcare_public_key: '21569b4e891b0cc1ea36',
      });
    </script>
    
@endpush