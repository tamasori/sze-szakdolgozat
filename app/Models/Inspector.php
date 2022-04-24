<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspector extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function inspectionRecords()
    {
        return $this->hasMany(InspectionRecord::class, "inspector_id", "id");
    }
}
