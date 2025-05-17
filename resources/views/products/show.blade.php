@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-3">
 <div class="col-md-10">
   <div class="card">
     <div class="card-header">
       <div class="float-start">
         Product Information
       </div>
       <div class="float-end">
         <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
       </div>
     </div>
     <div class="card-body">
       <div class="row align-items-start">
         <!-- Product details -->
         <div class="col-md-6 pe-3"> {{-- Less right padding --}}
           <div class="row mb-2">
             <label class="col-md-5 col-form-label text-md-end text-start"><strong>Code:</strong></label>
             <div class="col-md-7" style="line-height: 35px;">
               {{ $product->code }}
             </div>
           </div>
           <div class="row mb-2">
             <label class="col-md-5 col-form-label text-md-end text-start"><strong>Name:</strong></label>
             <div class="col-md-7" style="line-height: 35px;">
               {{ $product->name }}
             </div>
           </div>
           <div class="row mb-2">
             <label class="col-md-5 col-form-label text-md-end text-start"><strong>Quantity:</strong></label>
             <div class="col-md-7" style="line-height: 35px;">
               {{ $product->quantity }}
             </div>
           </div>
           <div class="row mb-2">
             <label class="col-md-5 col-form-label text-md-end text-start"><strong>Price:</strong></label>
             <div class="col-md-7" style="line-height: 35px;">
               {{ $product->price }}
             </div>
           </div>
           <div class="row mb-2">
             <label class="col-md-5 col-form-label text-md-end text-start"><strong>Description:</strong></label>
             <div class="col-md-7" style="line-height: 35px;">
               {{ $product->description }}
             </div>
           </div>
         </div>

         <!-- Product image -->
         <div class="col-md-6 d-flex justify-content-start">
           @if($product->image)
             <img src="{{ asset('storage/' . $product->image) }}"
                  alt="Product Image"
                  class="img-fluid img-thumbnail"
                  style="max-height: 350px; width: auto;">
           @else
             <p class="text-muted">No image uploaded</p>
           @endif
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection
