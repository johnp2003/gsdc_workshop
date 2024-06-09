<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20',
        ]);

        Customer::create($validatedData);
        
        return redirect()->route('customers.index')->with('success', 'Customer record added successfully.');
    }

    public function edit(string $id)
    {
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, string $id)
    {
        $customer = Customer::find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('customers')->ignore($customer->id),
            ],
            'phone' => 'required|string|max:20',
        ]);

        $customer->update($validatedData);

        return redirect()->route('customers.index')->with('success', 'Customer record updated successfully.');
    }

    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer record deleted successfully.');
    }

    public function show(string $id)
    {
        $customer = Customer::find($id);
        return view('customers.show', compact('customer'));
    }
}
