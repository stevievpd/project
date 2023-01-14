<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\Product;
use App\Models\Inventory\Category;
use App\Models\Inventory\Supplier;
use App\Models\Inventory\Debts_Supplier;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\Product_in_Warehouse;

use DB;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('inventory.dashboard');
    }


    // Product Index
    public function index()
    {

        $products = Product::with('category', 'supplier')
            ->whereNull('deleted_at')
            ->get();
        $category = Category::with('product')
            ->whereNull('deleted_at')
            ->get();
        $supplier = Supplier::with('debtSupplier')
            ->whereNull('deleted_at')
            ->get();
        $debtSupplier = Debts_Supplier::with('supplier')
            ->whereNull('deleted_at')
            ->get();
        $warehouse = Warehouse::with('products')
            ->get()
            ->whereNull('deleted_at');
        $warehouseProduct = Product_in_WareHouse::with('product', 'warehouse')
            ->get()
            ->whereNull('deleted_at');
        return view('inventory.product', compact(['products', 'category', 'supplier', 'debtSupplier', 'warehouse', 'warehouseProduct']));
    }
    // Supplier Index
    public function supplierIndex()
    {
        $supplier = Supplier::with('debtSupplier')
            ->whereNull('deleted_at')
            ->get();
        $debtSupplier = Debts_Supplier::with('supplier')
            ->whereNull('deleted_at')
            ->get();

        return view('inventory.supplier', compact(['supplier', 'debtSupplier']));
    }

    // Warehouse Index
    public function warehouseIndex()
    {
        $warehouse = Warehouse::with('products')
            ->get()
            ->whereNull('deleted_at');

        $warehouseProduct = Product_in_WareHouse::with('product', 'warehouse')
            ->get()
            ->whereNull('deleted_at');
        return view('inventory.warehouse', compact(['warehouseProduct', 'warehouse']));
    }

    public function storeWarehouse(Request $request)
    
    {
        $warehouse = new Warehouse();

        $warehouse->warehouse_name = $request->input('warehouse_name');
        $warehouse->warehouse_description = $request->input('warehouse_description');
        $warehouse->abrr = $request->input('abrr');
        $warehouse->save();

        $msg = "New $warehouse->warehouse_name Warehouse has been Added.";
        return redirect()
            ->back()
            ->with(['msg' => $msg]);
    }

    public function editWarehouse($id)
    {
        $warehouse = Warehouse::find($id);
        return response()->json($warehouse);
    }

    public function updateWarehouse(Request $request)
    {
        $id = $request->input('warehouse_id');
        $warehouse_name = $request->input('warehouse_name');
        $warehouse_description = $request->input('warehouse_description');
        $abrr = $request->input('abrr');

        warehouse::where('id', $id)
            ->update([
                'warehouse_name' => $warehouse_name,
                'warehouse_description' => $warehouse_description,
                'abrr' => $abrr,
            ]);
        $msg = 'Warehouse has been Updated';

        return redirect()
            ->back()
            ->with(['msg' => $msg]);
    }

    public function deleteWarehouse(Request $request){
        $id = $request->input('warehouse_id');

        warehouse::where('id', $id)
        ->update([
            'deleted_at' => now(),
        ]);
        $msg = "Warehouse has been Deleted";

    return redirect()->back()->with(['msgDel' => $msg]);
    }

    // Product Section
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

    public function deleteProduct(Request $request)
    {
        $id = $request->input('prod_id');

        DB::table('products')
            ->where('id', $id)
            ->update([
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
        $msg = 'Product has been Deleted';

        return redirect()
            ->back()
            ->with(['msgDel' => $msg]);
    }

    // Category Section

    public function storeCategory(Request $request)
    {
        $cat = new Category();

        $cat->category_name = $request->input('category_name');
        $cat->category_description = $request->input('category_description');
        $cat->save();

        $msg = "New $cat->category_name category has been Added.";
        return redirect()
            ->back()
            ->with(['msg' => $msg]);
    }

    public function editCategory($id)
    {
        $cat = Category::find($id);
        return response()->json($cat);
    }

    public function updateCategory(Request $request)
    {
        $id = $request->input('cat_id');
        $category_name = $request->input('category_name');
        $category_description = $request->input('category_description');

        DB::table('categories')
            ->where('id', $id)
            ->update([
                'category_name' => $category_name,
                'category_description' => $category_description,
            ]);
        $msg = 'Category has been Updated';

        return redirect()
            ->back()
            ->with(['msg' => $msg]);
    }

    public function deleteCategory(Request $request)
    {
        $id = $request->input('cat_id');

        DB::table('categories')
            ->where('id', $id)
            ->update([
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
        $msg = 'Category has been Deleted';

        return redirect()
            ->back()
            ->with(['msgDel' => $msg]);
    }
}
