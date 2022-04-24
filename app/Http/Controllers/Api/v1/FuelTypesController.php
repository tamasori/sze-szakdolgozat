<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Export;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Orion\Concerns\DisablePagination;
use Orion\Http\Controllers\Controller;

class FuelTypesController extends Controller
{
    use DisablePagination;

    protected $model = FuelType::class;
}
