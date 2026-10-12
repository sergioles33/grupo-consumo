<?php

namespace App\Models;

use app\models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    //campos protegidos
    protected $fillable = [
        'user_id',
        'status',
        'total',
        'delivery_date',
        'observations'
    ];

    //relaciones de tablas

    // 2. Relación: Un pedido pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

// 3. Relación: Un pedido tiene muchos productos (Muchos a Muchos)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
    
}
