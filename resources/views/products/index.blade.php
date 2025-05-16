@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-3">
  <div class="col-md-12">
    @session('success')
      <div class="alert alert-success" role="alert">
        {{ $value }}
      </div>
    @endsession
    <div class="card">
      <div class="card-header">Product List</div>
      <div class="card-body">
        <a href="{{ route('products.create') }}" class="btn btn-success btn-sm my-2">
          <i class="bi bi-plus-circle"></i> Add New Product
        </a>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col">S#</th>
              <th scope="col">Code</th>
              <th scope="col">Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
              <th scope="col">Image</th> {{-- Added Image column --}}
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($products as $product)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $product->code }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td>
                  @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="Product Image" width="70" height="70" 
                         style="object-fit: cover; border-radius: 5px;">
                  @else
                    <span class="text-muted">No image</span>
                  @endif
                </td>
                <td>
                  <form action="{{ route('products.destroy', $product->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning btn-sm">
                      <i class="bi bi-eye"></i> Show
                    </a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                      <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return confirm('Do you want to delete this product?');">
                      <i class="bi bi-trash"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center">
                  <span class="text-danger"><strong>No Product Found!</strong></span>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
        {{ $products->links() }}
      </div>
    </div>
  </div> 
</div>
@endsection
