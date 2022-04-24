<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Color;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Export;
use Illuminate\Http\Request;
use Orion\Concerns\DisablePagination;
use Orion\Http\Controllers\Controller;

class ColorsController extends Controller
{
    use DisablePagination;

    protected $model = Color::class;
}
