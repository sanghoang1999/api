<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Requests\ProductRequest;
use Auth;
use App\Exceptions\ProductNotBelongToUser;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth:api')->except('index','show');
    }
    public function index()
    {
        return  ProductCollection::collection(Product::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->user_id=Auth::id();
        $product->name=$request->name;
        $product->detail=$request->description;
        $product->price=$request->price;
        $product->stock=$request->stock;
        $product->discount=$request->discount;
        $product->save();
        return response([
           'data'=>  new ProductResource($product)
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {  
        return new ProductResource($product);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {   $this->ProductUserCheck($request);
        $request['detail']=$request->description;
        unset($request['description']);
        $product->update($request->all());
        return response([
            'data'=>  new ProductResource($product)
         ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response([
            'Message'=>"Delete successfull"
        ],204);
    }
    public function ProductUserCheck($request) 
    {
        if(Auth::id()!=$request->user_id) {
            throw new ProductNotBelongToUser;
        } 
    }
}
