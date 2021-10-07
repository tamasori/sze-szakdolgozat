<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Color;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Export;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class ColorsController extends Controller
{
    protected $model = Color::class;
}
