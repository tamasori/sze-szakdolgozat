<?php


namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;

class CustomersController
{
    function index(){
        return view("customers.index");
    }
    public function create()
    {
        return view("customers.edit");
    }

    public function store(CustomerStoreRequest $request)
    {
        $customer = Customer::create($request->validated());
        return redirect()->route("customers.edit",$customer)
                         ->with("successes",[__("messages.save_success")]);
    }

    public function edit(Customer $customer)
    {
        return view("customers.edit")
            ->with('customer', $customer);
    }

    public function update(CustomerStoreRequest $request, Customer $customer)
    {
        $customer = $customer->update($request->validated());
        return redirect()->route("customers.edit",$customer)
                         ->with("successes",[__("messages.save_success")]);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->back()->with("successes",[__("messages.delete_success")]);
    }

}
