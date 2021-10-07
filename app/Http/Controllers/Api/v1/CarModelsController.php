<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Export;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class CarModelsController extends Controller
{
    protected $model = CarModel::class;
}