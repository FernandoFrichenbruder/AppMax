<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'active',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for the order.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public static function getCompleteOrder($orderId)
    {
        $completeOrder = DB::table('orders')
                    ->join('items', 'orders.id', '=', 'items.order_id')
                    ->join('skus', 'items.sku_id', '=', 'skus.id')
                    ->select('orders.*', 'items.*', 'skus.sku', 'skus.price')
                    ->where('orders.id', $orderId)
                    ->get();

        return $completeOrder;
    }

}
