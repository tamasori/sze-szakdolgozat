<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Scopes\ExcludeSpecialEwcCodeFromSubstancesScope;

class Car extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::saved(function (Car $car) {
            $car->calculateAndSaveSpecialEwcCodes();
        });
    }

    public function calculateAndSaveSpecialEwcCodes(){
        $this->substances()->withoutGlobalScopes()->updateOrCreate([
            "ewc_code_id" => EwcCode::where("code", "=", "160104")->first()->id,
            "car_id" => $this->id,
        ],[
            "date" => $this->date_of_demolition,
            "mass" => $this->retrieved_weight,
            "in_material_balance" => true,
            "company_name" => config("company.name"),
            "ktj_number" => config("company.ktj_number"),
            "kuj_number" => config("company.kuj_number"),
        ]);

        $this->substances()->withoutGlobalScopes()->updateOrCreate([
            "ewc_code_id" => EwcCode::where("code", "=", "160106")->first()->id,
            "car_id" => $this->id,
        ],[
            "date" => $this->date_of_demolition,
            "mass" => $this->dry_weight,
            "on_site_transfer_mass" => $this->dry_weight,
            "in_material_balance" => true,
            "company_name" => config("company.name"),
            "ktj_number" => config("company.ktj_number"),
            "kuj_number" => config("company.kuj_number"),
            "treatment_code" => "R4"
        ]);
    }

    public static function getNextLocalIdentifier(){
        return static::query()->max("local_identifier") + 1;
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class,"fuel_type_id","id");
    }

    public function carModel()
    {
        return $this->belongsTo(CarModel::class,"car_model_id","id");
    }

    public function carMake()
    {
        return $this->hasOneThrough(CarMake::class,CarModel::class,"id","id","car_model_id","make_id");
    }

    public function color()
    {
        return $this->belongsTo(Color::class,"color_id","id");
    }

    public function substances(){
        return $this->hasMany(Substance::class,"car_id","id");
    }

    public function getNextCar(){
        return static::where("local_identifier",">", $this->local_identifier)->orderBy("local_identifier")->limit(1)->first();
    }

    public function getPreviousCar(){
        return static::where("local_identifier","<", $this->local_identifier)->orderBy("local_identifier","desc")->limit(1)->first();
    }
}
