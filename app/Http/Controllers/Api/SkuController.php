<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sku;

class SkuController extends Controller
{
    /**
     * Update SKU amount
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $data = $request->all();
        $quantity = $data['quantity'];
        $data['quantity'] = $data['quantity'] * -1;
        $sku = Sku::updateAmount($data);

        $history = \App\Models\ProductHistory::create([
            'sku_id' => $sku->id,
            'action' => 'Entrada pela API',
            'quantity' => $quantity,
            'trigger' => 'API',
        ]);

        return ['success' => $sku];
    }

    /**
     * Update SKU amount
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deduct(Request $request)
    {
        $data = $request->all();
        $sku = \App\Models\Sku::updateAmount($data);

        $history = \App\Models\ProductHistory::create([
            'sku_id' => $sku->id,
            'action' => 'Baixa pela API',
            'quantity' => $data['quantity'] * -1,
            'trigger' => 'API',
        ]);

        return ['success' => $sku];
    }
}
