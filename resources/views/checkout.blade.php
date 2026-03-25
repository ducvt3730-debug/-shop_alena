@extends('layouts.app')

@section('title', 'Thanh toán - Alena')

@section('content')
<style>
	.checkout-container {
		margin: 50px 0;
	}
	.page-title {
		font-size: 28px;
		font-weight: bold;
		text-align: center;
		margin-bottom: 40px;
		color: #333;
	}
	.checkout-form {
		display: flex;
		gap: 40px;
		align-items: flex-start;
	}
	.billing-info {
		flex: 2;
		background: white;
		padding: 30px;
		border-radius: 8px;
		box-shadow: 0 2px 10px rgba(0,0,0,0.1);
	}
	.order-summary {
		flex: 1;
		background: white;
		padding: 30px;
		border-radius: 8px;
		box-shadow: 0 2px 10px rgba(0,0,0,0.1);
	}
	.section-title {
		font-size: 20px;
		font-weight: bold;
		margin-bottom: 20px;
		color: #333;
	}
	.form-group {
		margin-bottom: 20px;
	}
	.form-label {
		display: block;
		margin-bottom: 8px;
		font-weight: 600;
		color: #333;
	}
	.form-input {
		width: 100%;
		padding: 12px 15px;
		border: 1px solid #ddd;
		border-radius: 4px;
		font-size: 14px;
	}
	.form-input:focus {
		outline: none;
		border-color: #d32f2f;
	}
	.form-row {
		display: flex;
		gap: 15px;
	}
	.form-row .form-group {
		flex: 1;
	}
	.payment-methods {
		margin: 20px 0;
	}
	.payment-option {
		display: flex;
		align-items: center;
		padding: 15px;
		border: 1px solid #ddd;
		border-radius: 4px;
		margin-bottom: 10px;
		cursor: pointer;
		transition: all 0.3s;
	}
	.payment-option:hover {
		border-color: #d32f2f;
	}
	.payment-option input[type="radio"] {
		margin-right: 10px;
	}
	.payment-option.selected {
		border-color: #d32f2f;
		background-color: #fff8f8;
	}
	.order-item {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 15px 0;
		border-bottom: 1px solid #eee;
	}
	.order-item:last-child {
		border-bottom: none;
	}
	.item-info {
		flex: 1;
	}
	.item-name {
		font-weight: 600;
		color: #333;
		margin-bottom: 5px;
	}
	.item-quantity {
		color: #666;
		font-size: 14px;
	}
	.item-price {
		color: #d32f2f;
		font-weight: 600;
	}
	.summary-row {
		display: flex;
		justify-content: space-between;
		margin: 15px 0;
		padding: 15px 0;
		border-bottom: 1px solid #eee;
	}
	.summary-row:last-child {
		border-bottom: none;
		font-weight: bold;
		font-size: 18px;
		color: #d32f2f;
	}
	.btn-place-order {
		width: 100%;
		padding: 15px;
		background-color: #d32f2f;
		color: white;
		border: none;
		border-radius: 4px;
		font-size: 16px;
		font-weight: 600;
		cursor: pointer;
		margin-top: 20px;
	}
	.btn-place-order:hover {
		background-color: #b71c1c;
	}
	.error-text {
		color: #d32f2f;
		font-size: 13px;
		margin-top: 5px;
	}
</style>

<div class="container">
	<div class="checkout-container">
		<h1 class="page-title">Thanh toán</h1>
		<form method="POST" action="{{ route('checkout.process') }}" class="checkout-form">
			@csrf
			<div class="billing-info">
				<h3 class="section-title">Thông tin giao hàng</h3>
				<div class="form-row">
					<div class="form-group">
						<label class="form-label" for="name">Họ và tên *</label>
						<input type="text" id="name" name="name" class="form-input" value="{{ old('name', $user->name ?? '') }}" required>
						@error('name')
							<div class="error-text">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label class="form-label" for="phone">Số điện thoại *</label>
						<input type="text" id="phone" name="phone" class="form-input" value="{{ old('phone', $user->phone ?? '') }}" required>
						@error('phone')
							<div class="error-text">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-group">
					<label class="form-label" for="email">Email *</label>
						<input type="email" id="email" name="email" class="form-input" value="{{ old('email', $user->email ?? '') }}" required>
					@error('email')
						<div class="error-text">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label class="form-label" for="address">Địa chỉ giao hàng *</label>
					<textarea id="address" name="address" class="form-input" rows="3" required>{{ old('address', $user->address ?? '') }}</textarea>
					@error('address')
						<div class="error-text">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label class="form-label" for="note">Ghi chú đơn hàng</label>
					<textarea id="note" name="note" class="form-input" rows="3" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn.">{{ old('note') }}</textarea>
				</div>
				<h3 class="section-title">Phương thức thanh toán</h3>
				<div class="payment-methods">
					<div class="payment-option" onclick="selectPayment('cod')">
						<input type="radio" name="payment_method" value="cod" id="cod" checked>
						<label for="cod">
							<strong>Thanh toán khi nhận hàng (COD)</strong><br>
							<small>Thanh toán bằng tiền mặt khi nhận hàng</small>
						</label>
					</div>
					<div class="payment-option" onclick="selectPayment('bank_transfer')">
						<input type="radio" name="payment_method" value="bank_transfer" id="bank_transfer">
						<label for="bank_transfer">
							<strong>Chuyển khoản ngân hàng</strong><br>
							<small>Chuyển khoản trực tiếp vào tài khoản ngân hàng</small>
						</label>
					</div>
				</div>
			</div>
			<div class="order-summary">
				<h3 class="section-title">Đơn hàng của bạn</h3>
				@foreach($cart as $item)
				<div class="order-item">
<div class="item-info">
						<div class="item-name">{{ $item['name'] }}</div>
						@if(isset($item['size']) && $item['size'])
							<div class="item-size" style="color: #d32f2f; font-weight: 600; font-size: 14px; margin: 2px 0;">Size: {{ $item['size'] }}</div>
						@endif
						<div class="item-quantity">Số lượng: {{ $item['quantity'] }}</div>
					</div>
					<div class="item-price">{{ number_format($item['price'] * $item['quantity']) }}₫</div>
				</div>
				@endforeach
				<div class="summary-row">
					<span>Tạm tính:</span>
					<span>{{ number_format($total) }}₫</span>
				</div>
				<div class="summary-row">
					<span>Phí vận chuyển:</span>
					<span>Miễn phí</span>
				</div>
				<div class="summary-row">
					<span>Tổng cộng:</span>
					<span>{{ number_format($total) }}₫</span>
				</div>
				<button type="submit" class="btn-place-order">Đặt hàng</button>
			</div>
		</form>
	</div>
</div>
<script>
function selectPayment(method) {
	// Remove selected class from all options
	document.querySelectorAll('.payment-option').forEach(option => {
		option.classList.remove('selected');
	});
	// Add selected class to clicked option  
	this.classList.add('selected');
	// Check the radio button
	document.getElementById(method).checked = true;
}
// Set initial selected state
document.addEventListener('DOMContentLoaded', function() {
	document.querySelector('.payment-option').classList.add('selected');
});
</script>
@endsection