<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\EwcCode;
use App\Models\Export;
use Illuminate\Http\Request;
use Orion\Concerns\DisablePagination;
use Orion\Http\Controllers\Controller;

class EwcCodesController extends Controller
{
    use DisablePagination;

    protected $model = EwcCode::class;
}
