<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers =  Customer::paginate(20);
        return view('customers.index', compact('customers'));
        }


    public function create(): View
    {
        return view('customers.create');
        }

    public function sameProductsCustomers()
    {
        $customer =Customer::whereRaw("CONCAT(first_name, ' ', last_name) = ?", ['Isabelle Mayert'])->first();
        if (!$customer) {
            return view('customers.same_products_customers', ['customers' => collect()]);
        }
        $productIds = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
            ->where('orders.customer_id', $customer->id)
          ->pluck('product_orders.product_id');

        $customers = DB::table('orders')
            ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->whereIn('product_orders.product_id', $productIds)
            ->where('orders.customer_id', '!=', $customer->id)
            ->select([
                DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) as customer_name"),
                'customers.email',
                'products.name as product_name',
                'orders.order_date as order_date',
            ])
            ->orderBy('customer_name')
            ->get();
        return view('customers.same_products_customers', compact('customers'));
    }


    public function store(CustomerRequest $request): RedirectResponse
    {

        Customer::create($request->validated());
        // $customer = new Customer();
        // $customer->first_name = $request["first_name"];
        // $customer->last_name = $request["last_name"];
        // $customer->phone = $request["phone"];
        // $customer->address = $request["address"];
        // $customer->save();
        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
        }

    public function edit(Customer $customer): View
    {
        return view('customers.edit', compact('customer'));
        }


    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
        }

    public function delete(Customer $customer): View
    {
        return view('customers.delete', compact('customer'));
        }

    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
        }
    public function searchTerm(Request $request, $term)
    {

        $customers = Customer::where('first_name', 'like', "%{$term}%")
            ->orWhere('last_name', 'like', "%{$term}%")
            ->orWhere('email', 'like', "%{$term}%")
            ->orWhere('phone', 'like', "%{$term}%")
            ->orWhere('address', 'like', "%{$term}%")
            ->get();
  
        return response()->json($customers);
        }

    public function search(Request $request)
    {
$term = $request->input('term');
        $customers = Customer::where('first_name', 'like', "%{$term}%")
            ->orWhere('last_name', 'like', "%{$term}%")
            ->orWhere('email', 'like', "%{$term}%")
            ->orWhere('phone', 'like', "%{$term}%")
            ->orWhere('address', 'like', "%{$term}%")
            ->paginate(10);

        return response()->json([
            'customers' => $customers->items(),
            'pagination' => [
                'total' => $customers->total(),
                'per_page' => $customers->perPage(),
                'current_page' => $customers->currentPage(),
                'last_page' => $customers->lastPage(),
                'from' => $customers->firstItem(),
                'to' => $customers->lastItem(),
                'links' => $customers->linkCollection()->toArray()
            ]
        ]);
        }


    }


