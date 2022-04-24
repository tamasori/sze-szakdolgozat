<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Export;
use App\Models\Inspector;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class InspectorsController extends Controller
{
    protected $model = Inspector::class;
}
