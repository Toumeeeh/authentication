<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()


    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
     {
        $request->validate([
            'name'=> 'required',
            'price'=> 'required',
            'owner_email'=>'required|email',
            'description'=> 'required'
        ]);




        return Product::create($request->all());

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product =Product::find($id);
        if ($product !== null){

            $product->update($request->all());
            return response([

                'messege'=>'updated',
                'product'=> $product],201);
        }
        else{
            return response([

                'messege'=>'not found'],401);
        }

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

       $product= Product::find($id);
        if ($product !== null && $product->owner_email==auth()->user()->email){

            $product->delete();

        return response([

            'messege'=>'deleted'],201);
        }
        else{
            return response([

                'messege'=>'not found'],201);
        }

        }

    public function search( $name)
    {
         return Product::where('name','like','%'.$name.'%')->get();

    }


}
