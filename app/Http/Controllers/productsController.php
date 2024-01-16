<?php

namespace App\Http\Controllers;

use App\Models\productsModel;
use http\Env\Response;
use Illuminate\Http\Request;

class productsController extends Controller
{
    public function addProduct(Request $req) {
        $productId = $req->input('id')?? null;
        $product = $productId ? productsModel::find($productId) : new productsModel;
        $product->name = $req->input('name');
        $product->description = $req->input('description');
        $product->price = $req->input('price');
        $req->hasFile('file') ? $product->file_path =  $req->file('file')->store('products_Image'):'';
        $product->save();
        return $product;
    }

    function list() {
        return productsModel::all();
    }

    public function delete($id) {
        $result = productsModel::where('id',$id)->delete();
        return $result?['result'=>'Product has been deleted'] : ['result'=>'Product not found'];
    }

    public function item($id) {
        $product = productsModel::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function search($key) {
        $result = productsModel::where('name','like',"%$key%")->get();
        return $result?? ['result'=>'Product not found'];
    }
}
