<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Requests\InspectonRecordsStoreRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopMachinery extends Model
{
    use HasFactory, SoftDeletes, CreatedBy;
    protected $guarded = [];

    public function inspectionRecords()
    {
        return $this->hasMany(InspectionRecord::class, "workshop_machinery_id", "id");
    }

}
