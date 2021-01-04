<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
    ];

    /**
     * The categories that belong to the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the SKUs for the Product.
     */
    public function skus()
    {
        return $this->hasOne(Sku::class);
    }

    /**
     * Delete Cascade Items if order inactive
     */
    public static function deleteCascade($skuId)
    {
        $items = Item::where('sku_id', $skuId)->get();
        $return = 0;
        
        if($items->count() > 0){
            foreach( $items as $item ){
                $orderId = $item->order_id;
                $order = Order::find($orderId);
                
                if( $order->active == 0) {
                    $order->delete();
                    $return++;
                } else {
                    return 'Produto não pode ser deletado pois está em um Pedido Ativo!';
                }
            }
        } else {
            return 'deletar';
        }
        
        if($return < $items->count()){
            return 'Produto não pode ser deletado pois está em um Pedido Ativo!';
        } else {
            return 'deletar';
        }        
    }
}
