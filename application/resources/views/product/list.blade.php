@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if (Session::get('message'))
        {!!Session::get('message')!!}
        @endif

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <span>Product</span>

                @can('isCompany')
                <a href="{{route('product.create')}}" style="float:right">Create New</a>
                @endcan

                </div>

                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Product Category</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>
                            <th>Created At</th>

                            @can('isCompany')
                            <th>Action</th>
                            @endcan

                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @forelse($productLists as $product)
                        @php $i++; @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$product->product_name}}</td>
                            <td><img style="width:100px;" src="{{url('application/storage/app/public/product/'.$product->product_image)}}" alt=""></td>
                            <td>{{$product->category_id}}</td>
                            <td>{{$product->product_price}}</td>
                            <td>{{$product->product_quantity}}</td>
                            <td>{{$product->created_at->diffForHumans()}}</td>
                            @can('isCompany')
                            <td>
                            <a href="{{route('product.edit', $product->id)}}" class="btn btn-sm btn-warning" style="float:left;margin-right:5px;">Edit</a>
                            <form class="form-inline" action="{{route('product.destroy', $product->id)}}" method="post">
                            @method('DELETE')
                            @csrf 
                            <button type="submit" class="btn btn-sm btn-danger" style="margin-right:5px;">Delete</button>
                            </form>
                            </td>
                            @endcan

                        </tr>
                        @empty 
                        <tr>
                            <td colspan="6">No Found!</td>
                        </tr> 
                        @endforelse   
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="card-footer">
                {{$productLists->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
