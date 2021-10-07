<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Export;
use App\Models\Part;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class PartsController extends Controller
{
    protected $model = Part::class;
}
