<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\PredefinedAnswer;
use Illuminate\Http\Request;
use Orion\Concerns\DisablePagination;
use Orion\Http\Controllers\Controller;

class PredefinedAnswersController extends Controller
{
    use DisablePagination;

    protected $model = PredefinedAnswer::class;
}
