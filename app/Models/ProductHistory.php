<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku_id',
        'quantity',
        'action',
        'trigger',
        'order_id',
        'user_id',
    ];


    public static function newProducts()
    {
        $products = DB::table('products')
                        ->join('skus', 'skus.product_id', '=', 'products.id')
                        ->join('product_histories', 'product_histories.sku_id', '=', 'skus.id')
                        ->where('action', 'Criação inicial do Produto com SKU')
                        ->select('products.*', 'skus.*', 'product_histories.*', 'product_histories.created_at')->get();

        $total = DB::table('product_histories')
                        ->join('skus', 'product_histories.sku_id', '=', 'skus.id')
                        ->select('skus.sku', DB::raw('SUM(product_histories.quantity) as sum'))
                        ->where('product_histories.action', '=', 'Criação inicial do Produto com SKU')
                        ->groupBy('skus.sku')
                        ->get();
    
            $data = [
                'products' => $products,
                'total' => $total
            ];
            return $data;
    }

    public static function addedProducts()
    {
        $products = DB::table('products')
                        ->join('skus', 'skus.product_id', '=', 'products.id')
                        ->join('product_histories', 'product_histories.sku_id', '=', 'skus.id')
                        ->where('quantity', '>', 0)->where('action', '<>', 'Criação inicial do Produto com SKU')
                        ->select('products.*', 'skus.*', 'product_histories.*', 'product_histories.created_at')->get();

        $total = DB::table('product_histories')
                    ->join('skus', 'product_histories.sku_id', '=', 'skus.id')
                    ->select('skus.sku', DB::raw('SUM(product_histories.quantity) as sum'))
                    ->where('product_histories.quantity', '>', 0)
                    ->where('product_histories.action', '<>', 'Criação inicial do Produto com SKU')
                    ->groupBy('skus.sku')
                    ->get();

        $data = [
            'products' => $products,
            'total' => $total
        ];
        return $data;
    }

    public static function reductedProducts()
    {
        $products = DB::table('products')
                        ->join('skus', 'skus.product_id', '=', 'products.id')
                        ->join('product_histories', 'product_histories.sku_id', '=', 'skus.id')
                        ->where('quantity', '<', 0)->where('action', '<>', 'Criação inicial do Produto com SKU')
                        ->select('products.*', 'skus.*', 'product_histories.*', 'product_histories.created_at')->get();
        
        $total = DB::table('product_histories')
                        ->join('skus', 'product_histories.sku_id', '=', 'skus.id')
                        ->select('skus.sku', DB::raw('SUM(product_histories.quantity) as sum'))
                        ->where('product_histories.quantity', '<', 0)
                        ->where('product_histories.action', '<>', 'Criação inicial do Produto com SKU')
                        ->groupBy('skus.sku')
                        ->get();

        $data = [
            'products' => $products,
            'total' => $total
        ];
        return $data;
    }


    public static function lowStock()
    {
        $products = DB::table('products')
                        ->join('skus', 'skus.product_id', '=', 'products.id')
                        ->where('skus.stock', '<', 100)
                        ->select('skus.sku','skus.stock')
                        ->get();

        return $products;
    }
}
