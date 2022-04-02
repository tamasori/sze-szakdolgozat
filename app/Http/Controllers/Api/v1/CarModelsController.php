<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Export;
use Illuminate\Http\Request;
use Orion\Concerns\DisablePagination;
use Orion\Http\Controllers\Controller;

class CarModelsController extends Controller
{
    use DisablePagination;

    protected $model = CarModel::class;
    public function filterableBy() : array
    {
        return ['make_id'];
    }
}
