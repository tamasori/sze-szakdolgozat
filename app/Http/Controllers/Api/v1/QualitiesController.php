<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Export;
use App\Models\Quality;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class QualitiesController extends Controller
{
    protected $model = Quality::class;
}
