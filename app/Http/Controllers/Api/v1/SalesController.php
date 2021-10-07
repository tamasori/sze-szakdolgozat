<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Export;
use App\Models\Sale;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class SalesController extends Controller
{
    protected $model = Sale::class;
}
