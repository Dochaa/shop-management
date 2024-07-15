<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
    
        $products = Products::query();
    
        if ($query) {
            $products = $products->where('name', 'LIKE', "%{$query}%");
        }
    
        if ($category) {
            $products = $products->where('category', $category);
        }
    
        $products = $products->get();
    
        return view('products.index', compact('products'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //create resource
        return view('products.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'code' => 'required',
            'release_date' => 'required|date',
            'status' => 'required',
        ]);
        
        $product = new Products();
        $product->name = $request->name;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->release_date = $request->release_date;
        $product->code = $request->cod ??  null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $product->image = $filename;
        }

        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Products::find($id);
        return view('products.show', compact('product'));
    }


    public function edit($id)
    {
        $product = Products::find($id);
        return view('products.form', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'code' => 'required',
            'release_date' => 'required|date',
            'status' => 'required',
        ]);
        
        $product = Products::find($id);
        $product->name = $request->name;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->release_date = $request->release_date;
        $product->code = $request->code;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $product->image = $filename;
        }

        $product->save();
        return redirect()->route('products.index');
    }
    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}