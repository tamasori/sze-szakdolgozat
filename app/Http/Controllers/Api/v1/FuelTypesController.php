<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Export;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class FuelTypesController extends Controller
{
    protected $model = FuelType::class;
}
