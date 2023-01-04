<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory\product;
use App\Models\Inventory\category;

use DB;


class InventoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $category = DB::table('category')->get()->whereNull('deleted_at');

        $product = DB::table('product')
            ->join('category', 'category.id', '=', 'product.category_id')
            // ->select('product.id as prod_id', 'product_name', 'product_description', 'price', 'quantity', 'category.id as cat_id', 'category_name')
            ->get()->whereNull('product.deleted_at');

        $data = [
            'product' => $product,
            'category' => $category,
        ];

        return view('inventory.product', $data);
    }

    public function storeProduct(Request $request){
        $prod = new product;

        $prod->product_name = $request->input('product_name');
        $prod->product_description = $request->input('product_description');
        $prod->category_id = $request->input('category');
        $prod->price = $request->input('price');
        $prod->quantity = $request->input('quantity');
        $prod->save();
    
        $msg = "New Product has been created.";
        return redirect()->back()->with(['msg' => $msg]);
    }

    public function editProduct($id){
        $prod = new product;
        
        $prod1 = $prod::find($id);
        return response()->json($prod1);

    }

    public function updateProduct(Request $request){

        $id = $request->input('prod_id');
        $product_name = $request->input('product_name');
        $product_description = $request->input('product_description');
        $category = $request->input('category');
        $price = $request->input('price');
        $quantity = $request->input('quantity');

        DB::table('product')
            ->where('id', $id)
            ->update([
                'product_name' => $product_name,
                'product_description' => $product_description,
                'category_id' => $category,
                'price' => $price,
                'quantity' => $quantity,
            ]);
            $msg = "$product_name has been Updated";

        return redirect()->back()->with(['msg' => $msg]);
    }

}
