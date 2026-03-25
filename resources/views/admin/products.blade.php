@extends('layouts.admin')

@section('title', 'Trang Quản Trị - Hệ Thống CRUD')
@section('page-title', 'Quản lý sản phẩm')

@section('content')
<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2c3e50;
        --success-color: #27ae60;
        --warning-color: #f39c12;
        --danger-color: #e74c3c;
        --light-color: #ecf0f1;
        --dark-color: #34495e;
    }

    /* Alert */
    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        display: none;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Card */
    .card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 20px;
        margin-bottom: 20px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .card-title {
        font-size: 1.3rem;
        color: var(--secondary-color);
        font-weight: 600;
    }

    /* Button */
    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        color: white;
    }

    .btn-primary:disabled {
        background-color: #95a5a6;
        cursor: not-allowed;
        opacity: 0.6;
    }

    .btn-success {
        background-color: var(--success-color);
        color: white;
    }

    .btn-success:hover {
        background-color: #219653;
        color: white;
    }

    .btn-warning {
        background-color: var(--warning-color);
        color: white;
    }

    .btn-warning:hover {
        background-color: #e67e22;
        color: white;
    }

    .btn-danger {
        background-color: var(--danger-color);
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
        color: white;
    }

    /* Table */
    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: var(--secondary-color);
    }

    tr:hover {
        background-color: #f9f9f9;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 0.85rem;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        width: 90%;
        max-width: 600px;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .modal-header {
        padding: 20px;
        background-color: var(--secondary-color);
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-size: 1.4rem;
        font-weight: 600;
    }

    .close-btn {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .modal-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #555;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
        transition: border 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    .modal-footer {
        padding: 20px;
        background-color: #f8f9fa;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .status-available {
        background-color: #d4edda;
        color: #155724;
    }
    .status-outofstock {
        background-color: #f8d7da;
        color: #721c24;
    }
    .status-discontinued {
        background-color: #fff3cd;
        color: #856404;
    }

    .stats-grid {
        display: flex; 
        gap: 20px; 
        flex-wrap: wrap;
    }

    .stat-card {
        flex: 1; 
        min-width: 200px; 
        padding: 15px; 
        border-radius: 5px;
    }

    .stat-primary {
        background-color: #e8f4fc;
    }

    .stat-success {
        background-color: #e8f8ef;
    }

    .stat-warning {
        background-color: #fef5e7;
    }

    .stat-title {
        margin-bottom: 10px;
    }

    .stat-number {
        font-size: 2rem; 
        font-weight: bold;
    }
</style>

<!-- Alert Messages -->
<div id="success-alert" class="alert alert-success">
    <i class="fas fa-check-circle"></i> Thao tác thành công!
</div>

<div id="error-alert" class="alert alert-danger">
    <i class="fas fa-exclamation-circle"></i> Đã xảy ra lỗi!
</div>

<!-- Card -->
<div class="card">
    <div class="card-header">
        <div>
            <div class="card-title">Danh sách sản phẩm</div>
            <small style="color: #666;">Hiện có {{ $totalProducts ?? 0 }}/100 sản phẩm</small>
        </div>
        <button class="btn btn-primary" id="add-product-btn" {{ (isset($totalProducts) && $totalProducts >= 100) ? 'disabled' : '' }}>
            <i class="fas fa-plus"></i> Thêm sản phẩm
        </button>
    </div>
    
    <div class="table-responsive">
        <table id="products-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="products-list">
                @foreach(isset($products) && is_iterable($products) ? $products : [] as $product)
                <tr>
                    <td>{{ $product->id ?? '' }}</td>
                    <td>{{ $product->name ?? '' }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>{{ isset($product->price) ? number_format($product->price) . '₫' : '' }}</td>
                    <td>{{ $product->stock ?? '' }}</td>
                    <td>
                        <span class="status-badge {{ (isset($product->stock) && $product->stock > 0) ? 'status-available' : 'status-outofstock' }}">
                            {{ (isset($product->stock) && $product->stock > 0) ? 'Còn hàng' : 'Hết hàng' }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $product->id ?? '' }}">
                                <i class="fas fa-edit"></i> Sửa
                            </button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $product->id ?? '' }}">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Thống kê</div>
    </div>
    <div class="stats-grid">
        <div class="stat-card stat-primary">
            <h3 style="color: var(--primary-color);" class="stat-title">Tổng sản phẩm</h3>
            <p class="stat-number" id="total-products">{{ $totalProducts ?? 0 }}</p>
        </div>
        <div class="stat-card stat-success">
            <h3 style="color: var(--success-color);" class="stat-title">Sản phẩm có sẵn</h3>
            <p class="stat-number" id="available-products">{{ $availableProducts ?? 0 }}</p>
        </div>
        <div class="stat-card stat-warning">
            <h3 style="color: var(--warning-color);" class="stat-title">Sản phẩm hết hàng</h3>
            <p class="stat-number" id="outofstock-products">{{ $outOfStockProducts ?? 0 }}</p>
        </div>
    </div>
</div>

<!-- Modal thêm/sửa sản phẩm -->
<div id="product-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title" id="modal-title">Thêm sản phẩm mới</div>
            <button class="close-btn" id="close-modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="product-form">
                @csrf
                <input type="hidden" id="product-id">
                <div class="form-group">
                    <label for="product-name">Tên sản phẩm *</label>
                    <input type="text" id="product-name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="product-category">Danh mục *</label>
                    <select id="product-category" class="form-control" required>
                        <option value="">Chọn danh mục</option>
                        @foreach(isset($categories) && is_iterable($categories) ? $categories : [] as $category)
                        <option value="{{ $category->id ?? '' }}">{{ $category->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="product-price">Giá *</label>
                    <input type="number" id="product-price" class="form-control" min="0" step="1000" required>
                </div>
                <div class="form-group">
                    <label for="product-quantity">Số lượng *</label>
                    <input type="number" id="product-quantity" class="form-control" min="0" required>
                </div>
                <div class="form-group">
                    <label for="product-description">Mô tả</label>
                    <textarea id="product-description" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="product-status">Trạng thái</label>
                    <select id="product-status" class="form-control">
                        <option value="1">Còn hàng</option>
                        <option value="0">Hết hàng</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn" id="cancel-btn">Hủy</button>
            <button class="btn btn-success" id="save-product-btn">Lưu sản phẩm</button>
        </div>
    </div>
</div>

<!-- Modal xác nhận xóa -->
<div id="delete-modal" class="modal">
    <div class="modal-content" style="max-width: 400px;">
        <div class="modal-header">
            <div class="modal-title">Xác nhận xóa</div>
            <button class="close-btn" id="close-delete-modal">&times;</button>
        </div>
        <div class="modal-body">
            <p>Bạn có chắc chắn muốn xóa sản phẩm <strong id="delete-product-name"></strong> không?</p>
            <p style="color: var(--danger-color);">Hành động này không thể hoàn tác!</p>
        </div>
        <div class="modal-footer">
            <button class="btn" id="cancel-delete-btn">Hủy</button>
            <button class="btn btn-danger" id="confirm-delete-btn">Xóa sản phẩm</button>
        </div>
    </div>
</div>

<script>
    let currentProductId = null;
    let deleteProductId = null;

    // DOM Elements
    const productsList = document.getElementById('products-list');
    const addProductBtn = document.getElementById('add-product-btn');
    const productModal = document.getElementById('product-modal');
    const deleteModal = document.getElementById('delete-modal');
    const closeModalBtns = document.querySelectorAll('.close-btn, #cancel-btn, #cancel-delete-btn');
    const saveProductBtn = document.getElementById('save-product-btn');
    const productForm = document.getElementById('product-form');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    const successAlert = document.getElementById('success-alert');
    const errorAlert = document.getElementById('error-alert');

    // Hiển thị modal thêm/sửa
    function showProductModal(productId = null) {
        const modalTitle = document.getElementById('modal-title');
        const form = document.getElementById('product-form');
        
        if (productId) {
            modalTitle.textContent = "Sửa sản phẩm";
            currentProductId = productId;
            
            fetch(`/admin/products/${productId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const product = data.product;
                        document.getElementById('product-id').value = product.id;
                        document.getElementById('product-name').value = product.name;
                        document.getElementById('product-category').value = product.category_id;
                        document.getElementById('product-price').value = product.price;
                        document.getElementById('product-quantity').value = product.stock;
                        document.getElementById('product-description').value = product.description || '';
                        document.getElementById('product-status').value = product.status ? '1' : '0';
                    }
                });
        } else {
            modalTitle.textContent = "Thêm sản phẩm mới";
            form.reset();
            document.getElementById('product-id').value = '';
            currentProductId = null;
        }
        
        productModal.style.display = 'flex';
    }

    // Hiển thị modal xóa
    function showDeleteModal(productId) {
        const row = document.querySelector(`button[data-id="${productId}"]`).closest('tr');
        const productName = row.querySelector('td:nth-child(2)').textContent;
        document.getElementById('delete-product-name').textContent = productName;
        deleteProductId = productId;
        deleteModal.style.display = 'flex';
    }

    // Ẩn modal
    function hideModals() {
        productModal.style.display = 'none';
        deleteModal.style.display = 'none';
    }

    // Hiển thị thông báo
    function showAlert(type, message = '') {
        const alertText = message || (type === 'success' ? 'Thao tác thành công!' : 'Đã xảy ra lỗi!');
        
        if (type === 'success') {
            successAlert.innerHTML = `<i class="fas fa-check-circle"></i> ${alertText}`;
            successAlert.style.display = 'block';
            errorAlert.style.display = 'none';
            
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 3000);
        } else {
            errorAlert.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${alertText}`;
            errorAlert.style.display = 'block';
            successAlert.style.display = 'none';
            
            setTimeout(() => {
                errorAlert.style.display = 'none';
            }, 5000);
        }
    }

    // Xử lý lưu sản phẩm
    function saveProduct() {
        const name = document.getElementById('product-name').value;
        const category_id = document.getElementById('product-category').value;
        const price = parseInt(document.getElementById('product-price').value);
        const quantity = parseInt(document.getElementById('product-quantity').value);
        const description = document.getElementById('product-description').value;
        const status = document.getElementById('product-status').value;
        const token = document.querySelector('input[name="_token"]').value;
        const productId = document.getElementById('product-id').value;

        if (!name || !category_id || price < 0 || quantity < 0) {
            showAlert('error', 'Vui lòng nhập đầy đủ thông tin hợp lệ!');
            return;
        }

        const url = productId ? `/admin/products/${productId}` : "{{ route('admin.products.store') }}";
        const method = productId ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name,
                category_id,
                price,
                quantity,
                description,
                status
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                hideModals();
                showAlert('success', data.message || (productId ? 'Đã cập nhật sản phẩm!' : 'Đã thêm sản phẩm!'));
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showAlert('error', data.message || 'Có lỗi xảy ra!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'Có lỗi xảy ra khi kết nối đến server!');
        });
    }

    // Xóa sản phẩm
    function deleteProduct() {
        const token = document.querySelector('input[name="_token"]').value;
        
        fetch(`/admin/products/${deleteProductId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                hideModals();
                showAlert('success', data.message || 'Đã xóa sản phẩm!');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showAlert('error', data.message || 'Có lỗi xảy ra!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'Có lỗi xảy ra khi kết nối đến server!');
        });
    }

    // Gắn sự kiện cho các nút
    function attachEventListeners() {
        // Nút sửa
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const productId = parseInt(e.target.closest('.edit-btn').dataset.id);
                showProductModal(productId);
            });
        });
        
        // Nút xóa
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const productId = parseInt(e.target.closest('.delete-btn').dataset.id);
                showDeleteModal(productId);
            });
        });
    }

    // Xử lý sự kiện khi tải trang
    document.addEventListener('DOMContentLoaded', () => {
        attachEventListeners();
        
        // Sự kiện nút thêm sản phẩm
        addProductBtn.addEventListener('click', () => {
            if (addProductBtn.disabled) {
                showAlert('error', 'Đã đạt giới hạn 100 sản phẩm. Vui lòng xóa sản phẩm cũ trước khi thêm mới.');
                return;
            }
            showProductModal();
        });
        
        // Sự kiện đóng modal
        closeModalBtns.forEach(btn => {
            btn.addEventListener('click', hideModals);
        });
        
        // Sự kiện lưu sản phẩm
        saveProductBtn.addEventListener('click', saveProduct);
        
        // Sự kiện xác nhận xóa
        confirmDeleteBtn.addEventListener('click', deleteProduct);
        
        // Đóng modal khi click bên ngoài
        window.addEventListener('click', (e) => {
            if (e.target === productModal) hideModals();
            if (e.target === deleteModal) hideModals();
        });
    });
</script>
@endsection