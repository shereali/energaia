@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Session::get('message'))
            <span class="alert alert-success col-md-8">{{Session::get('message')}}</span>
         @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <span>Create New Category</span>
                <a href="{{route('category.index')}}" style="float:right;">Category List</a>

                </div>
                <div class="card-body">
                    <form action="

                    @if (@$editCat) 
                    {{route('category.update', $editCat->id)}} 
                    @else 
                    {{route('category.store')}}
                    @endif"

                    method="post">

                    @if (@$editCat)
                    @method('PUT')
                    @endif

                    @csrf
                        <div class="form-group row">
                            <label for="category_name" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>
                            <div class="col-md-6">
                                <input id="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') }} {{@$editCat?$editCat->category_name:''}}" required autocomplete="category_name">

                                @error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button target="{{route('category.index')}}" type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
