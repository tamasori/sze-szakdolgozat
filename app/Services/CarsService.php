<?php


namespace App\Services;


use App\Models\Car;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Color;
use Illuminate\Http\Request;

class CarsService
{
    private Request $request;
    private ?Car $car;

    public function __construct(Request $request, Car $car = null)
    {
        $this->request = $request;
        $this->car     = $car;
    }

    final public function store(): Car
    {
        $carDetails = $this->getCarArray();
        if ($this->car) {
            $this->car->update($carDetails);
        } else {
            $this->car = Car::create($carDetails);
        }
        $this->saveFiles();
        $this->saveSubstances();
        return $this->car;
    }

    private function saveSubstances(): void
    {
        if ($this->request->has("substances") && ! empty($this->request->get("substances"))) {
            $substanceIds = [];
            foreach ($this->request->get("substances") as $rawSubstance) {
                $rawSubstance["car_id"]              = $this->car->getKey();
                $rawSubstance["in_material_balance"] = true;
                $substance                           = $this->car->substances()->updateOrCreate($rawSubstance);
                $substanceIds[]                      = $substance->getKey();
            }
            $this->car->substances()->whereNotIn("id", $substanceIds)->delete();
        }
    }

    private function saveFiles(): void
    {
        if ($this->request->hasFile("files")) {
            foreach ($this->request->file('files') as $file) {
                if ($file->isValid()) {
                    $this->car->addMedia($file)->toMediaCollection('files');
                }
            }
        }
    }

    private function getCarArray(): array
    {
        $data                       = $this->request->all();
        $carDetails                 = $data["car"];
        $carDetails["color_id"]     = $this->getColorFromColorString()->getKey();
        $carMake                    = $this->getCarMakeFromCarMakeString();
        $carModel                   = static::getCarModelFromCarModelString($carMake);
        $carDetails["car_model_id"] = $carModel->getKey();

        return $carDetails;
    }

    private function getColorFromColorString(): Color
    {
        $color      = $this->request->get("color");
        $colorModel = Color::where("name", "LIKE", $color)->first();
        if ( ! $colorModel) {
            $colorModel = Color::create(["name" => $color]);
        }

        return $colorModel;
    }

    private function getCarMakeFromCarMakeString(): CarMake
    {
        $carMake      = $this->request->get("car_make");
        $carMakeModel = CarMake::where("make", "LIKE", $carMake)->first();
        if ( ! $carMakeModel) {
            $carMakeModel = CarMake::create(["make" => $carMake]);
        }

        return $carMakeModel;
    }

    private function getCarModelFromCarModelString(CarMake $carMakeModel): CarModel
    {
        $carModel      = $this->request->get("car_model");
        $carModelModel = CarModel::where("model", "LIKE", $carModel)->where("make_id",
            $carMakeModel->getKey())->first();
        if ( ! $carModelModel) {
            $carModelModel = CarModel::create(["model" => $carModel, "make_id" => $carMakeModel->getKey()]);
        }

        return $carModelModel;
    }
}
