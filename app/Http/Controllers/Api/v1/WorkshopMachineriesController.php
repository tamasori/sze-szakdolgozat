<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Export;
use App\Models\WorkshopMachinery;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class WorkshopMachineriesController extends Controller
{
    protected $model = WorkshopMachinery::class;
}
