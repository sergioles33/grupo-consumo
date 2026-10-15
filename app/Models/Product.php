<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'stock',
        'unit_type',
        'image'
    ];

    // Relación: Un producto pertenece a un Productor (Usuario)
    public function producer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //un producto puede estar en muchos pedidos
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
                    ->withPivot('quantity','price')
                    ->withTimestamps();
    }
}
