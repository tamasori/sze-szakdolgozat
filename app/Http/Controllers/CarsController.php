<?php


namespace App\Http\Controllers;


use App\Models\Car;
use App\Services\CarsService;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CarsController
{
    function index(){
        return view("cars.index");
    }
    public function create()
    {
        return view("cars.edit");
    }

    public function store(Request $request)
    {
        $car = (new CarsService($request))->store();
        return redirect()->route("car.edit",$car)
                         ->with("successes",[__("messages.save_success")]);
    }

    public function edit(Car $car)
    {
        return view("cars.edit")
            ->with('car', $car);
    }

    public function update(Request $request, Car $car)
    {
        $car = (new CarsService($request,$car))->store();
        return redirect()->route("car.edit",$car)
                         ->with("successes",[__("messages.save_success")]);
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->back()->with("successes",[__("messages.delete_success")]);
    }

}
