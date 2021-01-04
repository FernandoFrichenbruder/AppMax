<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Helpers\OrderHelper;

class OrderController extends Controller
{
    private $order;

    /**
     * Instantiate a new OrderController instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['items'])->paginate(10);
        return view('admin.orders.index', compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = \App\Models\User::all(['id', 'name']);
        return view('admin.orders.create', compact('users'));
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
        $order = $this->order->create($data);

        flash('Pedido aberto! Adicione os produtos no pedido.');
        return redirect()->route('admin.orders.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderSingle = $this->order->with(['items'])->findOrFail($id);
        $completeOrder = Order::getCompleteOrder($id);
        
        $order = new OrderHelper($orderSingle, $completeOrder);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for add items to an order.
     *
     * @return \Illuminate\Http\Response
     */
    public function additems($id)
    {
        $products = \App\Models\Product::with('skus')->get();
        $orderSingle = $this->order->with(['items'])->findOrFail($id);
        $completeOrder = Order::getCompleteOrder($id);
        
        $order = new OrderHelper($orderSingle, $completeOrder);      

        return view('admin.orders.additems', compact('products', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}