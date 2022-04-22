<?php


namespace App\Http\Controllers;

use App\Http\Requests\EnquiryStoreRequest;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Part;
use App\Services\EnquiriesService;

class EnquiriesController
{
    function index(){
        return view("enquiries.index");
    }
    public function create()
    {
        $parts = Part::pluck("name", "id");
        $customers = Customer::pluck("name", "id");
        return view("enquiries.edit")
            ->with("parts", $parts)
            ->with("customers", $customers);
    }

    public function store(EnquiryStoreRequest $request)
    {
        $enquiry = (new EnquiriesService($request))->store();
        return redirect()->route("enquiries.edit",$enquiry)
                         ->with("successes",[__("messages.save_success")]);
    }

    public function edit(Enquiry $enquiry)
    {
        $parts = Part::pluck("name", "id");
        $customers = Customer::pluck("name", "id");
        return view("enquiries.edit")
            ->with("parts", $parts)
            ->with("customers", $customers)
            ->with('enquiry', $enquiry);
    }

    public function update(EnquiryStoreRequest $request, Enquiry $enquiry)
    {
        $enquiry = (new EnquiriesService($request, $enquiry))->store();
        return redirect()->route("enquiries.edit",$enquiry)
                         ->with("successes",[__("messages.save_success")]);
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return redirect()->back()->with("successes",[__("messages.delete_success")]);
    }

}
