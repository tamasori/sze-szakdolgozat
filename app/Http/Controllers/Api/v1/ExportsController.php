<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Export;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class ExportsController extends Controller
{
    protected $model = Export::class;
}
