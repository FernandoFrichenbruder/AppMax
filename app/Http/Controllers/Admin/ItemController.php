<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    private $item;

    /**
     * Instantiate a new Itemontroller instance.
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $item = Item::saveOrUpdate($data);

        $sku = \App\Models\Sku::updateAmount($data);

        $history = \App\Models\ProductHistory::create([
            'sku_id' => $sku->id,
            'action' => 'Adicionado em pedido',
            'quantity' => $data['quantity'],
            'trigger' => 'Site',
            'order_id' => $data['order_id'],
            'user_id' => $data['user_id'],
        ]);

        flash('Produto adicionado com Sucesso!')->success();
        return redirect()->route('admin.orders.populate', [$data['order_id']]);
    }

}
