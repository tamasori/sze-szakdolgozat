<?php

namespace App\Services;


use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiriesService
{
    private Request $request;
    private ?Enquiry $enquiry;

    public function __construct(Request $request, Enquiry $enquiry = null)
    {
        $this->request = $request;
        $this->enquiry     = $enquiry;
    }

    final public function store(): Enquiry
    {
        $enquiryDetails = $this->getEnquiryArray();
        if ($this->enquiry) {
            $this->enquiry->update($enquiryDetails);
        } else {
            $this->enquiry = Enquiry::create($enquiryDetails);
        }
        return $this->enquiry;
    }


    private function getEnquiryArray(): array
    {
        $data                       = $this->request->validated();
        $enquiryDetails             = [
            "part_id" => $data["part_id"],
            "customer_id" => $data["customer_id"],
            "car_year" => $data["car_year"],
            "note" => $data["note"] ?? "",
        ];

        $carMake                    = $this->getCarMakeFromCarMakeString();
        $carModel                   = $this->getCarModelFromCarModelString($carMake);
        $enquiryDetails["car_model_id"] = $carModel->getKey();

        return $enquiryDetails;
    }


    private function getCarMakeFromCarMakeString(): CarMake
    {
        $carMake      = $this->request->get("car_make");
        $carMakeModel = CarMake::where("make", "LIKE", $carMake)->first();
        if ( ! $carMakeModel) {
            $carMakeModel = CarMake::create(["make" => $carMake]);
        }

        return $carMakeModel;
    }

    private function getCarModelFromCarModelString(CarMake $carMakeModel): CarModel
    {
        $carModel      = $this->request->get("car_model");
        $carModelModel = CarModel::where("model", "LIKE", $carModel)->where("make_id",
            $carMakeModel->getKey())->first();
        if ( ! $carModelModel) {
            $carModelModel = CarModel::create(["model" => $carModel, "make_id" => $carMakeModel->getKey()]);
        }

        return $carModelModel;
    }
}
