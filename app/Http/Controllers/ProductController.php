<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index() : View
    {
        return view('products.index', [
            'products' => Product::latest()->paginate(4)
        ]);
    }

    /**
    * Show the form for creating a new resource.
    */
    public function create() : View
    {
        return view('products.create');
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store(StoreProductRequest $request) : RedirectResponse
{
    $data = $request->validated();

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('product_images', 'public');
    }


    Product::create($data);

    return redirect()->route('products.index')
        ->withSuccess('New product is added successfully.');
}


    /**
    * Display the specified resource.
    */
    public function show(Product $product) : View
    {
        return view('products.show', compact('product'));
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Product $product) : View
    {
        return view('products.edit', compact('product'));
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(UpdateProductRequest $request, Product $product) : RedirectResponse
    {
        // Update validated fields first
        $product->update($request->validated());

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product_images', 'public');
            $product->image = $path;
            $product->save(); // Save after assigning image
        }

        return redirect()->back()
            ->withSuccess('Product is updated successfully.');
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Product $product) : RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }
}
