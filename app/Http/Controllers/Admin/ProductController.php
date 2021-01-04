<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{
    private $product;

    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('skus')->paginate(10);
        return view('admin.products.index', compact('products'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Models\Category::all(['id', 'name']);

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $product = Product::create($data);
        $product->categories()->sync($data['categories']);
        $skuId = $product->skus()->create([
            'product_id' => $product->id,
            'sku' => $product->id . '-' . $product->name,
            'price' => $data['price'],
            'stock' => $data['stock'],
        ])->id;

        $history = \App\Models\ProductHistory::create([
            'sku_id' => $skuId,
            'action' => 'Criação inicial do Produto com SKU',
            'quantity' => $data['stock'],
            'trigger' => 'Site',
        ]);

        flash('Produto Criado com Sucesso');        
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->findOrFail($id);
        $categories = \App\Models\Category::all(['id', 'name']);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        $product = $this->product->find($id);
        $product->update($data);
        $product->categories()->sync($data['categories']);

        $sku = \App\Models\Sku::find($product->skus->id);
        $quantity = 0;
        if( $sku->stock >= $data['stock'] ){
            $quantity = ($sku->stock - $data['stock']) * -1;
            $action = 'Retirada por edição  manual do Produto';
        } else {
            $quantity = $data['stock'] - $sku->stock;
            $action = 'Entrada por edição  manual do Produto';
        }

        $product->skus()->update([
            'product_id' => $product->id,
            'sku' => $product->id . '-' . $product->name,
            'price' => $data['price'],
            'stock' => $data['stock'],
        ]);

        $history = \App\Models\ProductHistory::create([
            'sku_id' => $product->skus->id,
            'action' => $action,
            'quantity' => $quantity,
            'trigger' => 'Site',
        ]);

        flash('Produto Atualizado com Sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->with('skus')->find($id);
        $sku = $product->skus->sku;
        $cascade = Product::deleteCascade($sku);

       if($cascade == 'deletar') {
            $product->categories()->detach();
            $product->delete();
            flash('Produto Removido com Sucesso!')->success();
            return redirect()->route('admin.products.index');
        } else {
            flash($cascade)->warning();
            return redirect()->route('admin.products.index');
        }    
    } 
}
