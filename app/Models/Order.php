<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Danh sách các trạng thái đơn hàng
    const STATUS_PENDING = 'pending';           // Chờ xác nhận
    const STATUS_CONFIRMED = 'confirmed';       // Đã xác nhận
    const STATUS_SHIPPING = 'shipping';         // Đang giao
    const STATUS_COMPLETED = 'completed';       // Hoàn tất
    const STATUS_CANCELLED = 'cancelled';      // Đã hủy
    const STATUS_OPTIONAL = 'optional';        // Tùy (tùy chỉnh)
    const STATUS_FAILED_DELIVERY = 'failed_delivery'; // Giao thất bại
    const STATUS_REFUNDED = 'refunded';        // Đã hoàn

    protected $fillable = [
        'order_code', 'customer_name', 'customer_phone', 'customer_email',
        'customer_address', 'note', 'payment_method', 'subtotal', 
        'shipping_fee', 'total', 'status', 'user_id'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the user that owns the order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Lấy text hiển thị theo trạng thái đơn hàng
     */
    public function getStatusTextAttribute()
    {
        $statuses = [
            self::STATUS_PENDING => 'Chờ xác nhận',
            self::STATUS_CONFIRMED => 'Đã xác nhận',
            self::STATUS_SHIPPING => 'Đang giao',
            self::STATUS_COMPLETED => 'Hoàn tất',
            self::STATUS_CANCELLED => 'Đã hủy',
            self::STATUS_OPTIONAL => 'Tùy',
            self::STATUS_FAILED_DELIVERY => 'Giao thất bại',
            self::STATUS_REFUNDED => 'Đã hoàn'
        ];
        return $statuses[$this->status] ?? $this->status;
    }

    /**
     * Lấy danh sách tất cả các trạng thái
     */
    public static function getAllStatuses()
    {
        return [
            self::STATUS_PENDING => 'Chờ xác nhận',
            self::STATUS_CONFIRMED => 'Đã xác nhận',
            self::STATUS_SHIPPING => 'Đang giao',
            self::STATUS_COMPLETED => 'Hoàn tất',
            self::STATUS_CANCELLED => 'Đã hủy',
            self::STATUS_OPTIONAL => 'Tùy',
            self::STATUS_FAILED_DELIVERY => 'Giao thất bại',
            self::STATUS_REFUNDED => 'Đã hoàn'
        ];
    }

    /**
     * Kiểm tra đơn hàng có thể hủy không
     */
    public function canCancel()
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_CONFIRMED, self::STATUS_OPTIONAL]);
    }

    /**
     * Kiểm tra đơn hàng đang chờ xác nhận
     */
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Kiểm tra đơn hàng đã xác nhận
     */
    public function isConfirmed()
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    /**
     * Kiểm tra đơn hàng đang giao
     */
    public function isShipping()
    {
        return $this->status === self::STATUS_SHIPPING;
    }

    /**
     * Kiểm tra đơn hàng hoàn tất
     */
    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Kiểm tra đơn hàng đã hủy
     */
    public function isCancelled()
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    /**
     * Kiểm tra đơn hàng giao thất bại
     */
    public function isFailedDelivery()
    {
        return $this->status === self::STATUS_FAILED_DELIVERY;
    }

    /**
     * Kiểm tra đơn hàng đã hoàn
     */
    public function isRefunded()
    {
        return $this->status === self::STATUS_REFUNDED;
    }

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public function updateStatus($newStatus)
    {
        $validStatuses = array_keys(self::getAllStatuses());
        if (!in_array($newStatus, $validStatuses)) {
            return false;
        }
        $this->status = $newStatus;
        return $this->save();
    }
}
