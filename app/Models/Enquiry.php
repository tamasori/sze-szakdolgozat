<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use HasFactory, CreatedBy, SoftDeletes;
    protected $guarded = [];

    public function part() {
        return $this->belongsTo(Part::class, "part_id");
    }

    public function carModel() {
        return $this->belongsTo(CarModel::class, "car_model_id");
    }

    public function customer() {
        return $this->belongsTo(Customer::class, "customer_id");
    }
}
