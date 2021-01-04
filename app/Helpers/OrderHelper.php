<?php
namespace App\Helpers;

class OrderHelper
{
    private $order;
    private $completeOrder;
    public $id;
    public $user;
    public $active;
    public $created_at;
    public $updated_at;
    public $items; //array
    public $countItems;
    public $totalPrice;


    /**
     * Instantiate a new OrderHelper instance.
     */
    public function __construct($order, $completeOrder)
    {
        $this->order = $order;
        $this->completeOrder = $completeOrder;
        $this->mergeOrders();
    }

    public function mergeOrders()
    {
        $this->id = $this->order->id;

        $this->active = $this->order->active;
        $this->items = [];
        $i = 0;
        foreach($this->completeOrder as $item){
            $this->user = $item->user_id;
            $this->items[$i]['sku'] = $item->sku;
            $this->items[$i]['price'] = $item->price;
            $this->items[$i]['quantity'] = $item->quantity;
            $this->items[$i]['totalItemPrice'] = $item->price * $item->quantity;
            $this->countItems += $item->quantity;
            $this->totalPrice += $item->price * $item->quantity;
            $i++;
        }
    }
}