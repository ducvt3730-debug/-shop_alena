@extends('layouts.app')

@section('title', 'Hồ sơ cá nhân - Alena')

@section('content')
<style>
    .profile-container {
        max-width: 800px;
        margin: 50px auto;
        padding: 0 20px;
    }
    
    .page-title {
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }
    
    .profile-card {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }
    
    .user-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #d32f2f, #b71c1c);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 36px;
        margin: 0 auto 20px;
    }
    
    .user-name {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        color: #333;
        margin-bottom: 10px;
    }
    
    .user-email {
        text-align: center;
        color: #666;
        font-size: 16px;
        margin-bottom: 30px;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 15px;
    }
    
    .form-input, .form-textarea {
        width: 100%;
        padding: 15px;
        border: 2px solid #eee;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s;
        background: #fafafa;
    }
    
    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #d32f2f;
        background: white;
        box-shadow: 0 0 0 3px rgba(211, 47, 47, 0.1);
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .btn-save {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, #d32f2f, #b71c1c);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(211, 47, 47, 0.3);
    }
    
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-weight: 500;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .back-link {
        display: inline-block;
        margin-bottom: 20px;
        color: #666;
        text-decoration: none;
        font-weight: 500;
    }
    
    .back-link:hover {
        color: #d32f2f;
    }
    
    .back-link i {
        margin-right: 8px;
    }
</style>

<div class="profile-container">
    <a href="{{ route('home') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Quay lại trang chủ
    </a>
    
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    
    <div class="profile-card">
        <div class="user-avatar">
            <i class="fas fa-user"></i>
        </div>
        
        <div class="user-name">{{ auth()->user()->name }}</div>
        <div class="user-email">{{ auth()->user()->email }}</div>
        
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label" for="name">Họ và tên *</label>
                <input type="text" id="name" name="name" class="form-input" 
                       value="{{ old('name', auth()->user()->name) }}" required>
                @error('name')
                    <div style="color: #d32f2f; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="email">Email *</label>
                <input type="email" id="email" name="email" class="form-input" 
                       value="{{ old('email', auth()->user()->email) }}" required>
                @error('email')
                    <div style="color: #d32f2f; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="phone">Số điện thoại</label>
                <input type="text" id="phone" name="phone" class="form-input" 
                       value="{{ old('phone', auth()->user()->phone ?? '') }}">
                @error('phone')
                    <div style="color: #d32f2f; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="address">Địa chỉ giao hàng mặc định</label>
                <textarea id="address" name="address" class="form-textarea" 
                          placeholder="Nhập địa chỉ giao hàng thường dùng">{{ old('address', auth()->user()->address ?? '') }}</textarea>
                @error('address')
                    <div style="color: #d32f2f; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Cập nhật thông tin
            </button>
        </form>
    </div>
</div>
@endsection
