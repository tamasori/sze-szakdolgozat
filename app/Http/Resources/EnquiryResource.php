<?php

namespace App\Http\Resources;

use App\Models\Enquiry;
use Illuminate\Http\Resources\Json\JsonResource;

class EnquiryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'part_name' => $this->resource->part->name,
            'car_data' => [
                'make' => $this->resource->carModel->carMake->make,
                'model' => $this->resource->carModel->model,
                'year' => $this->resource->car_year,
            ],
            'note' => $this->resource->note
        ];
    }
}
