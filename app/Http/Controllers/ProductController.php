<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
    public function store(Request $request)
    {
        try {
            $product = new Product();
            $product->description = $request->description;
            $product->price = $request->price;
            $product->amount = $request->amount;
            $product->save();
            return $product;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        try {
            $product = Product::find($id);
            $product->description = $request->description;
            $product->price = $request->price;
            $product->amount = $request->amount;
            $product->save();
            return $product;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                throw new Exception("O produto já foi excluido!");
            }
            $product->delete();
            return response()->json("Cadastro excluido com sucesso!", 200);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function trashed()
    {
        return Product::onlyTrashed()->get();
    }

    public function restore($id)
    {
        try {
            $product = Product::onlyTrashed()->find($id);
            if (!$product) {
                throw new Exception("O produto já foi excluido!");
            }
            $product->restore();
            return response()->json("Cadastro restaurado com sucesso!", 200);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
