<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
    protected $fillable = [
        'sku',
        'img',
        'name',
        'description',
        'price',
        'id_bh',
        'quantity',
        'status',
        'category_id',
        'supploer_id',
    ];
}
