<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Car;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Export;
use App\Models\Preset;
use Illuminate\Http\Request;
use Orion\Concerns\DisablePagination;
use Orion\Http\Controllers\Controller;

class PresetsController extends Controller
{
    use DisablePagination;

    protected $model = Preset::class;
}
