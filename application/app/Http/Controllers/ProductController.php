<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $data['productLists'] = Product::paginate(5);

        return view('product.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::all();

        if (Gate::allows('isCompany', Auth::user())) {
            return view('product.create', $data);  
        } else {
            return redirect()->route('product.index')->withErrors("You are not allowed!");
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name'     => 'required|max: 80',
            'product_price'    => 'required',
            'product_quantity' => 'required'
        ]);
        
        if ($request->hasFile('product_image')) {
            $fileName = $request->product_image->getClientOriginalName();
            $request->product_image->storeAs('public/product', $fileName);   
        }

        $table                   = new Product;
        $table->product_name     = $request->product_name;
        $table->product_image    = $fileName;
        $table->category_id      = $request->category_id;
        $table->product_price    = $request->product_price;
        $table->product_quantity = $request->product_quantity;    
        $table->save();   
        
        return redirect()->back()->with('message', 'Product has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['editPro']    = Product ::find($id);
        $data['categories'] = Category::all();

        return view('product.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('product_image')) {
            $fileName = $request->product_image->getClientOriginalName();
            $request->product_image->storeAs('public/product', $fileName);   
        } else {
            $fileName = Product::find($id)->product_image;
        }

        $table                   = new Product;
        $table->product_name     = $request->product_name;
        $table->product_image    = $fileName;
        $table->category_id      = $request->category_id;
        $table->product_price    = $request->product_price;
        $table->product_quantity = $request->product_quantity;    
        $table->save(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_file = Product::find($id)->product_image;

        File::delete(storage_path('/app/public/product/'.$delete_file));

        Product::find($id)->delete();

        return redirect()->back()->with('message', '<span class="alert alert-danger col-md-8">Product has been deleted!</span>');
    }
}
