<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transactions::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($order) {
            $order->orderItems()->delete();
        });
    }
    protected $fillable = [
        'user_id',
        'total',
        'name',
        'phone',
        'email',
        'ward',
        'district',
        'province',
        'address',
        'status',
        'isPay',
        'setDate',
        'dropDate',
    ];
}
