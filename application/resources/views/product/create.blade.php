@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if (Session::get('message')) 
        <span class="alert alert-success col-md-8">{{session::get('message')}}</span>
        @endif 

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <span>Upload New Product</span>
                <a href="{{route('product.index')}}" style="float:right;">Product List</a>
                </div>
                <div class="card-body">
                <form action="

                @if (@$editPro)
                {{route('product.update', $editPro->id)}}
                @else 
                {{route('product.store')}}
                @endif

                " method="post" enctype='multipart/form-data'>

                @if (@$editPro)
                @method('PUT')
                @endif

                @csrf
                    <div class="form-group row">
                        <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>
                        <div class="col-md-6">
                            <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }} {{@$editPro->product_name}}" required autocomplete="product_name">

                            @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Product Category') }}</label>
                        <div class="col-md-6">
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option>Select category</option>

                            @foreach($categories as $category)
                            <option {{@$editPro->category_id == $category->id?"selected=selected":""}} value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach 

                            </select>

                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product_price" class="col-md-4 col-form-label text-md-right">{{ __('Product Price') }}</label>
                        <div class="col-md-6">
                            <input id="product_price" type="text" class="form-control @error('product_price') is-invalid @enderror" name="product_price" value="{{ old('product_price') }} {{@$editPro->product_price}}" required>

                            @error('product_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product_quantity" class="col-md-4 col-form-label text-md-right">{{ __('Product Quantity') }}</label>
                        <div class="col-md-6">
                            <input id="product_quantity" type="text" class="form-control @error('product_quantity') is-invalid @enderror" name="product_quantity" value="{{ old('product_quantity') }} {{@$editPro->product_quantity}}" required >
                            @error('product_quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product_image" class="col-md-4 col-form-label text-md-right">{{ __('Product Image') }}</label>
                        <div class="col-md-6">
                            <input id="product_image" type="file" class="form-control @error('product_image') is-invalid @enderror" name="product_image"  required>
                            <img style="width:100px; height:100px;" src="{{url('application/storage/app/public/product/'.@$editPro->product_image)}}" alt="">
                            @error('product_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
