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

    public function apindex()
    {
        $products = Product::with('skus')->paginate(10);
        return $products;
    }


    /**
     * Update SKU amount
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $data = $request->all();
        $data['quantity'] = $data['quantity'] * -1;
        $sku = \App\Models\Sku::updateAmount($data);

        flash('Produto adicionado com Sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Update SKU amount
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        $data = $request->all();
        $sku = \App\Models\Sku::updateAmount($data);

        flash('Produto adicionado com Sucesso!')->success();
        return redirect()->route('admin.products.index');
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
        $product->skus()->create([
            'product_id' => $product->id,
            'sku' => $product->id . '-' . $product->name,
            'price' => $data['price'],
            'stock' => $data['stock'],
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
        $product->skus()->update([
            'product_id' => $product->id,
            'sku' => $product->id . '-' . $product->name,
            'price' => $data['price'],
            'stock' => $data['stock'],
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
        $product = $this->product->find($id);
        $product->categories()->detach();
        $product->delete();

        flash('Produto Removido com Sucesso!')->success();
        return redirect()->route('admin.products.index');
    }
}
