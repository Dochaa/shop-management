@extends('layout')

@section('content')
<div class="container my-4">
    <div class="container bg-primary mb-4">
        <i class="bi bi-plus text-white mb-4"></i>
        <span class="text-white">{{ isset($product)? 'แก้ไขสินค้า' : 'เพิ่มสินค้า' }}</span>
    </div>
    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product))
        @method('PUT')
        @endif
        <div class="row g-3 mb-3">
            <div class="form-group col-sm-6">
                <label for="category">หมวดหมู่สินค้า</label>
                <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                    <option value="all"
                        {{ !isset($product) || (isset($product) && $product->category == 'all') ? 'selected' : '' }}>
                        all</option>
                    <option value="category1"
                        {{ isset($product) && $product->category == 'category1' ? 'selected' : '' }}>
                        category1</option>
                    <option value="category2"
                        {{ isset($product) && $product->category == 'category2' ? 'selected' : '' }}>
                        category2</option>
                    <option value="category3"
                        {{ isset($product) && $product->category == 'category3' ? 'selected' : '' }}>
                        category3</option>
                </select>
                @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-sm-12 my-4">
                <label for="image">อัปโหลดรูปภาพ <span>(ขนาดภาพ 734 x 1,104 pixel)</span></label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                    accept="image/*">
                <small class="form-text text-muted">*ไฟล์สกุล JPG,GIF,PNG เท่านั้น ขนาดไฟล์ต้องไม่เกิน 1,300
                    Pixel</small>
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="name">ชื่อสินค้า</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ $product->name ?? '' }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="code">รหัสสินค้า</label>
                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code"
                    value="{{ $product->code ?? '' }}">
                @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="release_date">วันที่เผยแพร่สินค้า</label>
                <input type="date" class="form-control @error('release_date') is-invalid @enderror" id="release_date"
                    name="release_date" value="{{ $product->release_date ?? '' }}">
                @error('release_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label>สถานะการเผยแพร่</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status"
                        id="published" value="published"
                        {{ isset($product) && $product->status == 'published' ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">เผยแพร่</label>
                </div>
                <div class="form-check form-check-inline col-sm-12">
                    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status"
                        id="draft" value="draft" {{ isset($product) && $product->status == 'draft' ? 'checked' : '' }}>
                    <label class="form-check-label" for="draft">แบบร่าง</label>
                </div>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-sm-12">
                <label for="description">รายละเอียดสินค้า</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description">{{ $product->description ?? '' }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <hr>
        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy2"></i>
                {{ isset($product) ? 'บันทึก' : 'เพิ่ม' }}</button>
        </div>
    </form>
</div>

<script>
document.getElementById('image').addEventListener('change', function() {
    var fileInput = this;
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (!allowedExtensions.exec(filePath)) {
        alert('กรุณาอัปโหลดไฟล์รูปภาพที่มีนามสกุล .jpeg/.jpg/.png/.gif เท่านั้น');
        fileInput.value = '';
        return false;
    }
});
</script>
@endsection