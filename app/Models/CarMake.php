<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarMake extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function carModels()
    {
        return $this->hasMany(CarModel::class,"make_id","id");
    }
}
