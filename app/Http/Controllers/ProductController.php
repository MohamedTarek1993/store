<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use File ;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $product = new Product();  

        // store image

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->store('', 'public');
            $filePath = 'uploads/' . $fileName;
            $product->image = $filePath;
        }
     
        // store product
        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->qty = $request->qty;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->save();

        // store color
        if($request->has('colors') && $request->filled('colors')){
            foreach ($request->colors as $color) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'name' => $color
                ]);
        }
        }
      //  store images
        if($request->hasFile('images')){
            foreach ($request->file('images') as $image) {
              $fileName = $image->store('' , 'public');
               $filePath = "uploads/" . $fileName;
              ProductImage::create([
                'product_id' => $product->id,
                'path' => $filePath

               ]);

            }
        }
        notify()->success('Product Created Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('colors', 'images')->findOrFail($id);
        $colors= $product->colors->pluck('name')->toArray();
        return view('admin.product.edit', compact('product' , 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $product = Product::findOrFail($id);  

        // store image

        if ($request->hasFile('image')) {
            // delete old image
            File::delete(public_path($product->image));
            $image = $request->file('image');
            $fileName = $image->store('', 'public');
            $filePath = 'uploads/' . $fileName;
            $product->image = $filePath;
        }
     
        // store product
        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->qty = $request->qty;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->save();

        // store color
        if($request->has('colors') && $request->filled('colors')){
            // delete old color
            foreach ($product->colors as $color) {
                $color->delete();
            }
            foreach ($request->colors as $color) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'name' => $color
                ]);
        }
        }
      //  store images
        if($request->hasFile('images')){
              // delete old color
              foreach ($product->images as $image) {
                File::delete(public_path($image->path));
            }
             $product->images()->delete();

            foreach ($request->file('images') as $image) {
              $fileName = $image->store('' , 'public');
               $filePath = "uploads/" . $fileName;
              ProductImage::create([
                'product_id' => $product->id,
                'path' => $filePath

               ]);

            }
        }
        notify()->success('Product Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        File::delete(public_path($product->image));
        $product->colors()->delete();
        foreach ($product->images as $image) {
            File::delete(public_path($image->path));
        }

        $product->delete();
        notify()->success('Product Deleted Successfully');
        return redirect()->back();

    }
}