<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Enquiry;
use App\Models\Export;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class EnquiriesController extends Controller
{
    protected $model = Enquiry::class;
}
