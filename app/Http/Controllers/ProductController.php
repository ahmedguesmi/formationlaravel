<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $products = Product::latest()->paginate(5);
        return view('products.index',compact('products'))->with('i',request()->input('page',1)-1*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()  : View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name'=>'required|string|regex:/^[^\d]+$/u',
            'short_description'=>'required',
            'price'=>'required|numeric',
            'long_description'=>'required',
        ]);

        $data = $request->all();

        Product::create($data);

        return redirect()->route('products.index')
        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'short_description'=>'required',
            'price'=>'required',
            'long_description'=>'required',
        ]);

        $data = $request->all();

       $product->update($data);

        return redirect()->route('products.index')
        ->with('success','Product created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
        ->with('success','Product deleted successfully.');
    }
}
