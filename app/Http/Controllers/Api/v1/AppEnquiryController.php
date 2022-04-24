<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Enquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\EnquiryResource;
use App\Http\Requests\EnquiryAnswerRequest;

class AppEnquiryController extends Controller
{
    public function open()
    {
        $enquiries = Enquiry::query()
                            ->whereNotNull("doable_at")
                            ->whereNull("closed_at")
                            ->whereNull("mechanic_id")
                            ->orderBy("created_at", "DESC")
                            ->get();

        return EnquiryResource::collection($enquiries);
    }

    public function own()
    {
        $enquiries = Enquiry::query()
                            ->whereNotNull("doable_at")
                            ->whereNull("closed_at")
                            ->whereNull("answer")
                            ->where("mechanic_id", auth()->id())
                            ->orderBy("created_at", "DESC")
                            ->get();

        return EnquiryResource::collection($enquiries);
    }

    public function take(Enquiry $enquiry)
    {
        abort_if($enquiry->mechanic_id, 403);

        $enquiry->update([
            "mechanic_id" => auth()->id(),
        ]);

        return EnquiryResource::make($enquiry);
    }

    public function answer(EnquiryAnswerRequest $request, Enquiry $enquiry)
    {
        abort_if($enquiry->mechanic_id != auth()->id() || ! empty($enquiry->answer), 403);

        $enquiry->update([
            "answer" => $request->get("answer"),
        ]);

        return EnquiryResource::make($enquiry);
    }
}
