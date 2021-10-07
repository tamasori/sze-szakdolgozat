<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Export;
use App\Models\InspectionRecord;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class InspectionRecordsController extends Controller
{
    protected $model = InspectionRecord::class;
}
