<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
     public function index(): View
    {
        $user = User::find(1); 
        $categories = Category::withCount('products')->get();
        
        $categoryLabels = $categories->pluck('name');
        $productCounts = $categories->pluck('products_count');

        $stores = Store::withCount('products')->get();

        $storeLabels = $stores->pluck('name');
        $storeCounts = $stores->pluck('products_count');

        return view('dashboard', [
            'pic' => $user->avatar,
            'categoryLabels' => $categoryLabels,
            'productCounts' => $productCounts,
            'storeLabels' => $storeLabels,
            'storeCounts' => $storeCounts
        ]);
    }


    public function customers(): View
    {
        $customers = Customer::paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function suppliers(): View
    {
        return view('suppliers.index', [
            'suppliers' => Supplier::all()
        ]);
    }

    public function products(): View
    {
        return view('products.index', [
            'products' => Product::with(['category', 'supplier', 'stock'])->get()
        ]);
    }

    public function productsBySupplier(): View
    {
        $suppliers = Supplier::all();
        return view('products.by-supplier', compact('suppliers'));
    }

    public function getProductsBySupplier(Supplier $supplier)
    {
        $products = Product::with(['stock','category'])
        ->where('supplier_id', $supplier->id)
        ->get();
        return view('products._products_by_supplier', compact('products'));
    }

    public function productsByStore(): View
    {
        $stores = Store::all();
        return view('products.by-store', compact('stores'));
    }

    public function getProductsByStore(Store $store)
    {
        $products = Product::with(['category', 'stock'])
            ->whereHas('stock', function($query) use ($store) {
                $query->where('store_id', $store->id);
            })
            ->get();
        return response()->json($products);
    }

    public function orders()
    {
        return view("orders.index");
    }
    
   public function saveCookie()
   {
      $name = request()->input("txtCookie");
      Cookie::queue("UserName",$name,6000000);
      return redirect()->back();
   }

   public function saveSession(Request $request)
   {
        $name = $request->input("txtSession");
        $request->session()->put('SessionName', $name);
        return redirect()->back();
   }
   public function saveAvatar()
   {
        request()->validate([
            'avatarFile'=>'required|image',
        ]);
        $text = request()->avatarFile->getClientOriginalExtension();
        $name = Str::random(30).time().".".$text;
        request()->avatarFile->move(storage_path('app/public/avatars'), $name);
        $user = User::find(1);
        if ($user) {
            $user->update(['avatar' => $name]);
        }
        return redirect()->back();
   }
}
