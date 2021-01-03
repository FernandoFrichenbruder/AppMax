<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity',
        'order_id',
        'sku_id',
    ];

    /**
     * Get the order that owns the item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the sku that owns the item.
     */
    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    /**
     * Get the item by sku_id and order_id
     */
    public static function getExisting($sku_id, $order_id)
    {
        $item = Item::where('sku_id', $sku_id)->where('order_id', $order_id)->get();
        return $item;
    }

    /**
     * Save or Update Item
     */
    public static function saveOrUpdate($data)
    {
        $searchItem = Item::getExisting($data['sku_id'], $data['order_id']);
        $quantity = $data['quantity'];
        if($searchItem->count() > 0){
            $foundItem = compact('searchItem');
            $item = Item::find($foundItem['searchItem'][0]->id);
            $data['quantity'] = $quantity + $foundItem['searchItem'][0]->quantity;
            $item->update($data);
            return true;
        } else {
            $item = Item::create($data);
            return true;
        }
    }

}


