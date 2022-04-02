<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function carMake()
    {
        return $this->belongsTo(CarMake::class,"make_id","id");
    }
}
