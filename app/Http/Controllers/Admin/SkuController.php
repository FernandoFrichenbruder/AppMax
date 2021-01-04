<?php

namespace App\Http\Controllers\Admin;

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
            'action' => 'Entrada rápida pela listagem de Produtos',
            'quantity' => $quantity,
            'trigger' => 'Site',
        ]);


        flash('Quantidade adicionada com Sucesso!')->success();
        return redirect()->route($data['route']);
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
            'action' => 'Baixa rápida pela listagem de Produtos',
            'quantity' => $data['quantity'] * -1,
            'trigger' => 'Site',
        ]);

        flash('Quantidade reduzida com Sucesso!')->success();
        return redirect()->route($data['route']);
    }

    
}
