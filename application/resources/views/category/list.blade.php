@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if(Session::get('message'))
            {!!Session::get('message')!!}
         @endif

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <span>Category</span>

                @can('isCompany')
                <a href="{{route('category.create')}}" style="float:right">Create New</a>
                @endcan 

                </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Category Name</th>
                            <th>Created At</th>

                            @can('isCompany')
                            <th>Action</th>
                            @endcan 

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categoryLists as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->created_at->diffForHumans()}}</td>

                            @can('isCompany')
                            <td>
                            <a class="btn btn-sm btn-warning" href="{{route('category.edit', $category->id)}}" style="float:left;margin-right:5px;">Edit</a>
                            <form action="{{route('category.destroy', $category->id)}}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button class="btn btn-sm btn-danger" style="margin-right:5px;">Delete</button>
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
            {{$categoryLists->links()}}
        </div>
    </div>
</div>
@endsection
