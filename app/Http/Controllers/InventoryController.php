<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\Product;
use App\Models\Inventory\Category;

use DB;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $category = Category::with('product')->get();
        return view('inventory.product', compact(['products', 'category']));
    }

    public function storeProduct(Request $request)
    {
        $prod = new Product();

        $prod->product_name = $request->input('product_name');
        $prod->product_description = $request->input('product_description');
        $prod->category_id = $request->input('category');
        $prod->price = $request->input('price');
        $prod->quantity = $request->input('quantity');
        $prod->save();

        $msg = "New $prod->product_name Product has been Added.";
        return redirect()
            ->back()
            ->with(['msg' => $msg]);
    }

    public function editProduct($id)
    {
        $prod = Product::find($id);
        return response()->json($prod);
    }

    public function updateProduct(Request $request)
    {
        $id = $request->input('prod_id');
        $product_name = $request->input('product_name');
        $product_description = $request->input('product_description');
        $category_id = $request->input('category');
        $price = $request->input('price');
        $quantity = $request->input('quantity');

        DB::table('products')
            ->where('id', $id)
            ->update([
                'product_name' => $product_name,
                'product_description' => $product_description,
                'category_id' => $category_id,
                'price' => $price,
                'quantity' => $quantity,
            ]);
        $msg = 'Product has been Updated';

        return redirect()
            ->back()
            ->with(['msg' => $msg]);
    }
}
