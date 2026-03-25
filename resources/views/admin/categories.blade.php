@extends('layouts.admin')
@section('title', 'Quản lý danh mục')
@section('page-title', 'Quản lý danh mục')
@section('content')
<div class="container mt-4">
    <h2>Danh sách danh mục</h2>
    <form action="{{ route('admin.categories.store') }}" method="POST" class="mb-4" id="add-category-form">
        @csrf
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label for="name" class="form-label">Tên danh mục *</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="description" class="form-label">Mô tả</label>
                <input type="text" name="description" id="description" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100">Thêm danh mục</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered" id="categories-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Slug</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->description }}</td>
                <td>{{ $category->status ? 'Hiện' : 'Ẩn' }}</td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa danh mục này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
// Tự động tạo slug
const nameInput = document.getElementById('name');
const slugInput = document.getElementById('slug');
if(nameInput && slugInput) {
    nameInput.addEventListener('input', function() {
        slugInput.value = this.value.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
    });
}
</script>
@endsection
