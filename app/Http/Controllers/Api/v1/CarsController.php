<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Export;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CarsController extends Controller
{
    protected $model = Car::class;


    public function deleteFile(Request $request,Media $file){
        $file->delete();
        return response()->json(["message" => __("messages.delete_success")]);
    }
}
