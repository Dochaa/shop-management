@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-body-tertiary">
    <div class="container my-4">
        <h1 class=" mb-4">Product</h1>
        <div class="container bg-danger my-4">
            <t class="text-white my-4"><i class="bi bi-search"></i> ค้นหา</t>
        </div>
        <form class="mb-4 row g-3" method="GET" action="{{ route('products.index') }}">
            <div class="form-group col-sm-4">
                <label>ชื่อสินค้า</label>
                <input type="text" name="query" class="form-control" placeholder="ค้นหาสินค้า"
                    value="{{ request()->input('query') }}">
            </div>
            <div class="form-group col-sm-4">
                <label>หมวดหมู่สินค้า</label>
                <select class="form-control" id="category" name="category">
                    <option value="">all</option>
                    <option value="category1" {{ request()->input('category') == 'category1' ? 'selected' : '' }}>
                        category1</option>
                    <option value="category2" {{ request()->input('category') == 'category2' ? 'selected' : '' }}>
                        category2</option>
                    <option value="category3" {{ request()->input('category') == 'category3' ? 'selected' : '' }}>
                        category3</option>
                </select>
            </div>
            <div class="container text-center">
                <button type="submit" class="btn btn-success"><i class="bi bi-search"></i> ค้นหา</button>
                <a href="{{ route('products.index') }}" class="btn btn-warning text-white"><i
                        class="bi bi-eraser-fill"></i> เคลียร์</a>
                <a href="{{ route('products.create') }}" class="btn btn-info">
                    <i class="bi bi-plus-circle-fill text-white"></i> เพิ่มสินค้า
                </a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th>ลำดับ</th>
                        <th>ภาพปก</th>
                        <th>ชื่อ</th>
                        <th>หมวดหมู่</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($product->image)
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                            @else
                            No image
                            @endif
                        </td>
                        <td>
                            <label>
                                {{$product->name}}
                            </label>
                            <p>วันที่สร้าง: {{$product->release_date}} | สร้างโดย : ผู้ดูแลระบบ สูงสุด</p>
                            <a class="btn btn-success text-white">เผยแพร่
                            </a>
                        </td>
                        <td>@if($product->category)
                            {{$product->category}}
                            @else
                            ทั้งหมด
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning text-white"><i
                                    class="bi bi-eye-fill"></i></a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info"><i
                                    class="bi bi-pencil-fill"></i></a>
                            <a href="" class="btn btn-primary"><i class="bi bi-brush-fill"></i></a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                style="display:inline;" onsubmit="return confirmDelete(event, '{{ $product->name }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" data-product-name="{{ $product->name }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>

<script>
function confirmDelete(event, productName) {
    event.preventDefault();
    Swal.fire({
        title: 'คุณแน่ใจ?',
        text: `คุณต้องการลบสินค้านี้: ${productName}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ใช่ ฉันต้องการลบมัน!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: 'ลบข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                event.target.submit();
            });
            console.log('Success');
        } else {
            console.log('fall to Success');
        }
    });
    return false;
}
</script>

@endsection